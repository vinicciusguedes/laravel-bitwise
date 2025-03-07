# Laravel Bitwise

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vinicciusguedes/laravel-bitwise.svg?style=flat-square)](https://packagist.org/packages/vinicciusguedes/laravel-bitwise/)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/vinicciusguedes/laravel-bitwise/build.yml?style=flat-square)](https://github.com/vinicciusguedes/laravel-bitwise/actions)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Pacote para facilitar a manipulação de números usando operações bitwise no Laravel. Ideal para casos de uso como gerenciamento de permissões e flags, fornecendo funções para verificar, ativar, desativar e inverter bits de forma simples e eficiente.

## Instalação

### Instalar via Composer

Você pode instalar o pacote através do Composer:

```bash
composer require vinicciusguedes/laravel-bitwise
```

## Compatibilidade: Laravel e PHP

Esta tabela mostra as versões do Laravel e suas versões compatíveis com o PHP.

| Laravel | PHP   |
|---------------|-----------------------|
| 12.*          | 8.4, 8.3, 8.2 |
| 11.*          | 8.4, 8.3, 8.2 |
| 10.*          | 8.4, 8.3, 8.2, 8.1, 8.0 |
| 9.*           | 8.4, 8.3, 8.2, 8.1, 8.0 |
| 8.*           | 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3 |
| 7.*           | 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2 |
| 6.*           | 8.4, 8.3, 8.2, 8.1, 8.0, 7.4, 7.3, 7.2 |

> A tabela de compatibilidade pode ser ajustada de acordo com novas atualizações de versões do PHP ou Laravel.

## Funcionalidades
O pacote oferece funções úteis para trabalhar com operações bitwise, como:

- Adiciona um bit a um valor atual
- Remove um bit de um valor
- Verifica se um bit está ativo
- Obtém todos os bits ativos de um valor
- Manipula bits em arrays

## Funções Disponíveis

✅ `addBit(int $currentValue, int $bit): int`
- Adiciona um bit ao valor atual usando a operação OR (|).
- Adds a specific bit to the current value using the OR (|) operation.

```php
$currentValue = 5; // 0101 em binário
$bitToAdd = 2;    // 0010 em binário
$newValue = Bitwise::addBit($currentValue, $bitToAdd); // 7 (0111 em binário)
```

___

✅ `addBits(int $currentValue, int $bit): int`
- Adiciona todos os bits fornecidos no valor atual usando operação OR (|).
- Adds all provided bits in the current value using the OR (|) operation.

```php
$currentValue = 5; // 0101 em binário
$bitToAdd = [2, 4]; 
$newValue = Bitwise::addBits($currentValue, $bitToAdd); // 7 (0111 em binário)
```

___

✅ `removeBit(int $currentValue, int $bit): int`
- Remove um bit específico do valor atual usando operação AND NOT (& ~).
- Removes a specific bit from the current value using the AND NOT (& ~) operation.

```php
$currentValue = 7; // 0111 em binário
$bitToRemove = 2;  // 0010 em binário
$newValue = Bitwise::removeBit($currentValue, $bitToRemove); // 5 (0101 em binário)
```

___

✅ `removeBits(int $currentValue, array $bits): int`
- Remove todos os bits fornecidos no valor atual usando operação AND NOT (& ~).
- Removes all provided bits in the current value using the AND NOT (& ~) operation.

```php
$currentValue = 15; // 1111 em binário
$bitToRemove = [1, 4];
$newValue = Bitwise::removeBits($currentValue, $bitToRemove); // 10 (1010 em binário)
```

___

✅ `hasBit(int $currentValue, int $bit): bool`
- Verifica se um bit específico está ativo no valor atual usando a operação AND (&).
- Checks if a specific bit is active in the current value using the AND (&) operation.

```php
$currentValue = 5;  // 0101 em binário
$bitToCheck = 4;    // 0100 em binário
$isActive = Bitwise::hasBit($currentValue, $bitToCheck); // true
```

___

✅ `hasAllBits(int $bitValue, array $bits): bool`
- Verifica se todos os bits fornecidos estão ativos no valor.
- Checks if all the provided bits are active in the value.

```php
$currentValue = 15; // 1111 em binário
$bitsArray = [1, 2, 4];
$allBitsActive = Bitwise::hasAllBits($currentValue, $bitsArray); // true
```

___

✅ `getActiveBits(int $value, bool $key_type = true, bool $order = true): array`
- Retorna todos os bits ativos no valor fornecido.
- Returns an array of all active bits in the value.

```php
$value = 7;  // 0111 em binário
$activeBits = Bitwise::getActiveBits($value); // [1, 2, 4]
```

___

✅ `sumActiveBits(array $bits): int`
- Retorna o valor total da soma dos bits ativos.
- Returns the total value of the sum of the active bits.

```php
$bits = [1, 2, 4];
$sum = Bitwise::sumActiveBits($bits); // 7
```

___

✅ `addBitInArray(array $array, int $bit, bool $key_type = true, bool $order = true): array`
- Adiciona um bit a um array, garantindo que o valor seja único.
- Adds a bit to an array, ensuring it is not duplicated.

```php
$bitsArray = [1, 2];
$newArray = Bitwise::addBitInArray($bitsArray, 4); // [1, 2, 4]
```

___

✅ `hasBitsInArray(int $bitValue, array $bits): array`
- Verifica se cada valor de um array está presente nos bits de um valor dado.
- Checks if each value in an array is present in the bits of a given value.

```php
$bitValue = 7;  // 0111 em binário
$bitsToCheck = [1, 2, 4];
$results = Bitwise::hasBitsInArray($bitValue, $bitsToCheck);
// [1 => true, 2 => true, 4 => true]
```

___

✅ `sortBitsByKey(array $bits): array`
- Ordena as chaves do array com base nas chaves.
- Sorts the keys of the array based on the keys.

```php
$bitsToCheck = [4 => 4, 2 => 2, 1 => 1];
$results = Bitwise::sortBitsByKey($bitsToCheck);
// [1 => 1, 2 => 2, 4 => 4]
```

___

✅ `sortBitsByValue(array $bits): array`
- Ordena array com base nos valores.
- Sorts the array based on the values.

```php
$bitsToCheck = [4,2,1];
$results = Bitwise::sortBitsByValue($bitsToCheck);
// [2 => 1, 1 => 2, 0 => 4]
```

___

✅ `toBinaryString(int $value): string`
- Converte um valor inteiro para uma string binária.
- Converts an integer value to a binary string.

```php
$number = 5;
$results = Bitwise::toBinaryString($number);
// 101
```

___

✅ `fromBinary(string $value): int`
- Converte um valor binário de volta para inteiro.
- Convert a binary value back to integer.

```php
$number = "101";
$results = Bitwise::fromBinary($number);
// 5
```

___

✅ `function invertBit(int $value): int`
- Inverte bit do valor.
- Invert the value bit.

```php
$bit = 1;
$results = Bitwise::invertBit($bit);
// 0
```

___ 
**Desenvolvedor:** Viníccius Guedes
