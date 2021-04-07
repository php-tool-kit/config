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

namespace PTK\Config\Indexer;

/**
 * Description of StringKeyIndexer
 *
 * @author Everton
 */
class StringKeyIndexer implements IndexerInterface
{
    /**
     *
     * @var array<mixed> O índice de configurações.
     */
    protected array $index = [];

    /**
     * Gera o índice de configurações.
     *
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function index(array $data): array
    {
        $this->recursive($data, '');

        return $this->index;
    }

    /**
     * Método auxiliar.
     *
     * @param array<mixed> $data
     * @param string $parentKey
     * @return void
     */
    protected function recursive(array $data, string $parentKey): void
    {
        foreach ($data as $key => $value) {
            if (\is_array($value) && ! \is_int(\array_key_first($value))) {
                $this->recursive($value, $key);
                continue;
            }/* else {*/
            if (\strlen($parentKey) > 0) {
                $key = $parentKey . ".$key";
            }
            $this->index[$key] = $value;
//            }
        }
    }
}
