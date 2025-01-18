# Laravel Bitwise

![version](https://img.shields.io/badge/Version-1.0-blue?style=flat-square)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Pacote para facilitar a manipulação de números usando operações bitwise no Laravel. Ideal para casos de uso como gerenciamento de permissões e flags, fornecendo funções para verificar, ativar, desativar e inverter bits de forma simples e eficiente.

## Instalação

### Instalar via Composer

Você pode instalar o pacote através do Composer:

```bash
composer require viniciusguedes/laravel-bitwise
```

## Funcionalidades
O pacote oferece funções úteis para trabalhar com operações bitwise, como:

- Adiciona um bit a um valor atual
- Remove um bit de um valor
- Verifica se um bit está ativo
- Obtém todos os bits ativos de um valor
- Manipula bits em arrays

## Funções Disponíveis

1. `addBit(int $currentValue, int $bit): int`
Adiciona um bit ao valor atual usando a operação OR (|).

```
$currentValue = 5; // 0101 em binário
$bitToAdd = 2;    // 0010 em binário
$newValue = Bitwise::addBit($currentValue, $bitToAdd); // 7 (0111 em binário)
```

___

2. `removeBit(int $currentValue, int $bit): int`
Remove um bit específico do valor atual usando a operação AND NOT (& ~).

```
$currentValue = 7; // 0111 em binário
$bitToRemove = 2;  // 0010 em binário
$newValue = Bitwise::removeBit($currentValue, $bitToRemove); // 5 (0101 em binário)
```
___

3. `hasBit(int $currentValue, int $bit): bool`
Verifica se um bit específico está ativo no valor atual usando a operação AND (&).

```
$currentValue = 5;  // 0101 em binário
$bitToCheck = 4;    // 0100 em binário
$isActive = Bitwise::hasBit($currentValue, $bitToCheck); // true
```

___

4. `getActiveBits(int $value, bool $key_type = true, bool $order = true): array`
Retorna todos os bits ativos no valor fornecido.

```
$value = 7;  // 0111 em binário
$activeBits = Bitwise::getActiveBits($value); // [1, 2, 4]
```

___

5. `sumActiveBits(array $bits): int`
Retorna a soma dos bits ativos.

```
$bits = [1, 2, 4];
$sum = Bitwise::sumActiveBits($bits); // 7
```

___

6. `addBitInArray(array $array, int $bit, bool $key_type = true, bool $order = true): array`
Adiciona um bit a um array, garantindo que o valor seja único.

```
$bitsArray = [1, 2];
$newArray = Bitwise::addBitInArray($bitsArray, 4); // [1, 2, 4]
```

___

7. `hasBitsInArray(int $bitValue, array $bits): array`
Verifica se cada valor de um array está presente nos bits de um valor dado.

```
$bitValue = 7;  // 0111 em binário
$bitsToCheck = [1, 2, 4];
$results = Bitwise::hasBitsInArray($bitValue, $bitsToCheck);
// [1 => true, 2 => true, 4 => true]
```

___ 
**Desenvolvedor:** Viníccius Guedes
