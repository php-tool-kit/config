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

namespace PTK\Config\Repository;

use PTK\Config\Indexer\IndexerInterface;
use PTK\Config\Indexer\StringKeyIndexer;
use UnexpectedValueException;

/**
 * Repositório de configurações. Um repositório de configurações é um objeto que retorna as configurações.
 *  É normalmente criado com \Config\Loader\ConfigLoader
 *
 * @author Everton
 */
class ConfigRepo implements ConfigRepoInterface
{
    /**
     *
     * @var array<mixed> As configurações chave=>valor conforme gerado por \Config\Indexer\IndexerInterface
     */
    protected array $repo = [];

    /**
     * Construtor. Embora seja público, é usado por \Config\Loader\ConfigLoader e não é recomendado a
     *  instanciação direta.
     *
     * @param array<mixed> $data As configurações no formato key=>value, onde key é gerado por
     *  \Config\Indexer\IndexerInterface
     * @param IndexerInterface $indexer Um indexador. O padrão é \Config\Indexer\StringKeyIndexer que forma
     *  uma chave do tipo level1.level2.level3.levelN
     */
    public function __construct(array $data, IndexerInterface $indexer = null)
    {
        if (\is_null($indexer)) {
            $indexer = new StringKeyIndexer();
        }

        $this->repo = $indexer->index($data);
    }

    public function __get(string $key)
    {
        return $this->get($key);
    }

    public function get(string $key)
    {
        if (\array_key_exists($key, $this->repo)) {
            return $this->repo[$key];
        }

        throw new UnexpectedValueException($key);
    }

    public function list(): array
    {
        return $this->repo;
    }
}
