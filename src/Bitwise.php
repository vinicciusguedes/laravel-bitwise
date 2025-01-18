<?php

namespace VG\LaravelBitwise;

class Bitwise
{
    /**
     * Adiciona um bit específico ao valor atual usando operação OR (|).
     * Adds a specific bit to the current value using the OR (|) operation.
     *
     * @param int $currentValue Valor atual onde os bits estão armazenados.
     * @param int $bit Valor do bit a ser adicionado (1, 2, 4, 8, etc.).
     * @return int Novo valor com o bit ativado.
     */
    public static function addBit(int $currentValue, int $bit): int
    {
        return $currentValue | $bit;
    }

    /**
     * Adiciona um bit em um array, garantindo que não seja duplicada.
     * Adds a bit to an array, ensuring it is not duplicated.
     *
     * @param array $array O array original para adicionar o bit.
     * @param int $bit O bit que será adicionado ao array.
     * @param bool $key_type Define o tipo de chave no array de retorno:
     *                       - `true` (padrão) para chaves crescentes (0, 1, 2,...)
     *                       - `false` para os números dos bits ativos (1, 2, 4,...)
     * @param bool $order Ordena o array por chave.
     * @return array O array atualizado com o novo bit adicionado, se não estiver presente.
     */
    public static function addBitInArray(array $array, int $bit, bool $key_type = true, bool $order = true): array
    {
        // Adiciona o bit se ainda não existir no array
        if (!in_array($bit, $array, true)) {

            if ($key_type) {
                $array[] = $bit;
            } else {
                $array[$bit] = $bit;
            }

        }

        // Ordena o array
        if ($order) {
            $array = self::sortBitsByKey($array);
        }

        return $array;
    }

    /**
     * Remove um bit específico do valor atual usando operação AND NOT (& ~).
     * Removes a specific bit from the current value using the AND NOT (& ~) operation.
     *
     * @param int $currentValue Valor atual onde os bits estão armazenados.
     * @param int $bit Valor do bit a ser removido (1, 2, 4, 8, etc.).
     * @return int Novo valor com o bit desativado.
     */
    public static function removeBit(int $currentValue, int $bit): int
    {
        return $currentValue & ~$bit;
    }

    /**
     * Verifica se um bit específico está ativo no valor atual usando operação AND (&).
     * Checks if a specific bit is active in the current value using the AND (&) operation.
     *
     * @param int $currentValue Valor atual onde os bits estão armazenados.
     * @param int $bit Valor do bit a ser verificado (1, 2, 4, 8, etc.).
     * @return bool Retorna true se o bit estiver ativo, false caso contrário.
     */
    public static function hasBit(int $currentValue, int $bit): bool
    {
        return ($currentValue & $bit) !== 0;
    }

    /**
     * Verifica se cada valor de um array está presente nos bits de um valor dado.
     * Checks if each value in an array is present in the bits of a given value.
     *
     * @param int $bitValue O valor base (bits) que será verificado.
     * @param array $bits O array de valores a serem verificados.
     * @return array Retorna um array associativo [valor => bool] indicando a presença de cada bit.
     */
    public static function hasBitsInArray(int $bitValue, array $bits): array
    {
        $result = [];

        foreach ($bits as $bit) {
            // Verifica se o bit está ativo
            $result[$bit] = ($bitValue & $bit) === $bit;
        }

        return $result;
    }

    /**
     * Retorna um array de todos os bits ativos no valor.
     * Returns an array of all active bits in the value.
     *
     * @param int $value Valor onde os bits estão armazenados.
     * @param bool $key_type Define o tipo de chave no array de retorno:
     *                       - `true` (padrão) para chaves crescentes (0, 1, 2,...)
     *                       - `false` para os números dos bits ativos (1, 2, 4,...)
     * @param bool $order Ordena o array por chave.
     * @return array Array com cada bit ativo (ex: [1, 2, 4, 8, etc.]).
     */
    public static function getActiveBits(int $value, bool $key_type = true, bool $order = true): array
    {
        $bits = [];
        $bitPosition = 0;

        // Percorre os bits do valor fornecido
        while ($value > 0) {
            $bitValue = 1 << $bitPosition; // Calcula o valor do bit (1, 2, 4, 8...)

            if (($value & $bitValue) !== 0) {
                // Adiciona ao array com base no tipo de chave
                if ($key_type) {
                    $bits[] = $bitValue;
                } else {
                    $bits[$bitValue] = $bitValue;
                }

                // Subtrai o bit encontrado para evitar duplicidade
                $value -= $bitValue;
            }
            $bitPosition++;
        }

        // Ordena o array
        if ($order) {
            $bits = self::sortBitsByKey($bits);
        }

        return $bits;
    }

    /**
     * Retorna o valor total da soma dos bits ativos.
     * Returns the total value of the sum of the active bits.
     *
     * @param array $bits Array de bits ativos.
     * @return int Valor da soma dos bits ativos.
     */
    public static function sumActiveBits(array $bits): int
    {
        return array_sum($bits);
    }

    /**
     * Ordena as chaves do array com base nos valores.
     * Sorts the keys of the array based on the values.
     *
     * @param array $bits O array de bits a ser ordenado.
     * @return array O array de bits ordenado pela chave em ordem crescente.
     */
    public static function sortBitsByKey(array $bits): array
    {
        // Ordena as chaves do array em ordem crescente
        ksort($bits, SORT_NUMERIC);

        return $bits;
    }
}
