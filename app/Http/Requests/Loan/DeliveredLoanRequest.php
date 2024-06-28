<?php

namespace App\Http\Requests\Loan;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\MultaDto;
use App\Models\Dto\PrestamoDto;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class DeliveredLoanRequest extends FormRequest implements ReturnDataInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $catalogoOpcionRepository = app(CatalogoOpcionRepositoryInterface::class);
        $multaRepository = app(MultaRepositoryInterface::class);

        $rules = [
            'estatusId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::ESTATUS_PRESTAMO->value)
            ]
        ];

        if (isset($this->estatusId)) {
            $estatus = $catalogoOpcionRepository->findById($this->estatusId);

            if ($estatus->opcion_id === EstatusPrestamoEnum::ENTREGADO->value) {
                $rules = array_merge($rules, ['fechaRealEntrega' => ['required', 'date', 'date_format:Y-m-d']]);

                $existFine = $multaRepository->findByLoanId($this->id);
                if ($existFine) {
                    $rules = array_merge($rules, [
                        'multa.estatusId' => [
                            'required',
                            'integer',
                            Rule::exists('catalogo_opciones', 'id')
                                ->where('catalogo_id', CatalogoEnum::ESTATUS_MULTA->value)
                        ]
                    ]);
                }
            } else if ($estatus->opcion_id === EstatusPrestamoEnum::PERDIDO->value) {
                $rules = array_merge($rules, [
                    'multa.estatusId' => [
                        'required',
                        'integer',
                        Rule::exists('catalogo_opciones', 'id')
                            ->where('catalogo_id', CatalogoEnum::ESTATUS_MULTA->value)
                    ]
                ]);
            }
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'fechaRealEntrega' => 'Fecha real de entrega',
            'estatusId' => 'Estatus',
            'multa.estatusId' => 'Estatus multa',
        ];
    }

    public function toData(): PrestamoDto
    {
        if (isset($this->multa)) {
            $fine = MultaDto::from($this->multa);
            return PrestamoDto::from(array_merge($this->all(), ['multa' => $fine]));
        }

        return PrestamoDto::from($this->all());
    }
}
