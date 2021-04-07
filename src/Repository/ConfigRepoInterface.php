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

/**
 * Interface  para o repositório de configurações.
 *
 * Um repositório de configurações é um objeto que retorna as configurações. É normalmente criado com
 *  \Config\Loader\ConfigLoader
 * @author Everton
 */
interface ConfigRepoInterface
{
    /**
     * Construtor. Embora seja público, é usado por \Config\Loader\ConfigLoader e não é recomendado a
     *  instanciação direta.
     *
     * @param array<mixed> $data As configurações no formato key=>value, onde key é gerado por
     *  \Config\Indexer\IndexerInterface
     */
    public function __construct(array $data);

    /**
     * Getter de configurações.
     *
     * @param string $key A chave da configuração, conforme gerada por Config\Indexer\IndexerInterface
     * @return mixed Retorna o valor da configuração.
     */
    public function get(string $key);

    /**
     * Método mágico para acesso direto da configuração simulando propriedades públicas.
     *
     * Por exemplo: ```$config->{"level1.level2.level3"}```
     *
     * @param string $key A chave da configuração, conforme gerada por \Config\Indexer\IndexerInterface
     * @return mixed Retorna o valor da configuração.
     */
    public function __get(string $key);

    /**
     * Lista todas as configurações no formato chave=>valor com as chaves geradas conforme
     *  Config\Indexer\IndexerInterface
     *
     * @return array<mixed>
     */
    public function list(): array;
}
