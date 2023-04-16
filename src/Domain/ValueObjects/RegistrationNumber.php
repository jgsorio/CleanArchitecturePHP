<?php

namespace Core\Domain\ValueObjects;

use DomainException;

class RegistrationNumber
{
    
    public function __construct(public string $registrationNumber)
    {
        if (!$this->validate($registrationNumber)) {
            throw new DomainException('Invalid Registration Number');
        }
    }

    private function validate(string $cpf): bool
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function __toString()
    {
        return substr($this->registrationNumber, 0, 3) . "." .
            substr($this->registrationNumber, 3, 3) . "." .
            substr($this->registrationNumber, 6, 3) . "-" .
            substr($this->registrationNumber, 9, 2);
    }
}
