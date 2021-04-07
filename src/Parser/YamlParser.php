<?php

/**
 * Prooph was here at `%package%` in `%year%`! Please create a .docheader in the project root and run `composer cs-fix`
 */

declare(strict_types=1);

/*
 * The MIT License
 *
 * Copyright 2021 Everton.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace PTK\Config\Parser;

use Exception;
use UnexpectedValueException;

/**
 * Parser para configurações em arquivos YAML.
 * 
 * Apenas o primeiro documento YAML do arquivo será utilizado.
 *
 * @author Everton
 */
class YamlParser implements ParserInterface
{
    protected string $yamlFile = '';

    public function __construct(string $source)
    {
        if (! \file_exists($source)) {
            throw new UnexpectedValueException($this->yamlFile);
        }

        $this->yamlFile = $source;
    }

    public function parse(): array
    {
        $data = \yaml_parse_file($this->yamlFile);
        if ($data === false) {
            throw new Exception($this->yamlFile);
        }

        return $data;
    }
}