# MiniUtils

A collection of useful functions that implemented as classes.

[![Build Status](https://travis-ci.org/Hy369/MiniUtils.svg?branch=master)](https://travis-ci.org/Hy369/MiniUtils) [![Coverage Status](https://coveralls.io/repos/github/Hy369/MiniUtils/badge.svg?branch=master)](https://coveralls.io/github/Hy369/MiniUtils?branch=master) [![Total Downloads](https://poser.pugx.org/hylin/miniutils/downloads)](https://packagist.org/packages/hylin/miniutils) [![Latest Unstable Version](https://poser.pugx.org/hylin/miniutils/v/unstable)](https://packagist.org/packages/hylin/miniutils) [![License](https://poser.pugx.org/hylin/miniutils/license)](https://packagist.org/packages/hylin/miniutils)

## Links

- Document: [https://hy369.github.io/MiniUtils](https://hy369.github.io/MiniUtils)

## Installation

```
composer require hylin/miniutils
```

## Usage

### MuString

#### utf8ToUnicode

Convert character from UTF-8 to Unicode.

##### Description

```
string utf8ToUnicode(string $str[, string $prefix = '\\u'[, string $suffix = ''[,
bool $reserveAscii = true]]])
```

##### Parameters

**str**

The string to be converted.

**prefix**

The prefix of string to be converted, the default is \\u

**suffix**

The suffix of string to be converted, the default is empty string.

**reserveAscii**

Whether the ascii character will be converted or not.

#### unicodeToUtf8

```
string unicodeToUtf8(string $str[, string $prefix = '\\u'[, string $suffix = '']])
```

#### replaceSuffix

```
string replaceSuffix(string $str, string $suffix)
```

#### getSuffix

```
string getSuffix($str[, $withDot = false])
```

### MuArray

#### keyMap

```
void function keyMap(array &$array, callable $callback)
```

#### merge

```
void merge(&$array1, ...$array2)
```

#### multiSort

```
void multiSort(&$array, $key[, $order = SORT_ASC[, $maintainIndex = false]])
```

### MuDate

#### timestampToUtc

```
string timestampToUtc(int $timestamp[, bool $minTime = false])
```