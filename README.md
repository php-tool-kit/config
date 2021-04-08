# Config
**Um pacote do *PHP Tool Kit*.**

**Config** é uma interface para acesso de configurações armazenadas em diferentes fontes que fornece um acesso padronizado aos valores de configurações independente da forma de armazenamento dessas configurações.

## Instalação

Recomendamos apenas a instalação via [Composer](https://getcomposer.org).

```bash
composer require php-tool-kit/conf-mgr
```

## Uso

```php

// Carrega um arquivo de configurações.
$config = PTK\Config\Loader\ConfigLoader::load('myconfig.ini');

// Retorna uma configuração específica
$confValue = $conf->get('configKey');

// As configurações podem ser estruturadas por níveis, como num array multidimensional.
$confValue = $conf->get('keyLevel1.keyLevel2.keyLeve3');

// Também é possível carregar múltiplos arquivos de configuração, inclusive de formatos diferentes, e mesclá-los.
$config = PTK\Config\Loader\ConfigLoader::load('myconfig.ini', 'myconf.yaml);

```

## Formatos suportados

Os seguintes formatos de arquivos são suportados atualmente:

- *.ini
- *.yaml|*.yml

## Documentação

A documentação da API está disponível em [https://php-tool-kit.github.io/config/](https://php-tool-kit.github.io/config/)

## Licença

Este pacote é distribuiído sobre a MIT Licence.