<?php

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

namespace ConfMgr\Loader;

/**
 * Loader de configurações.
 *
 * @author Everton
 */
class ConfigLoader {

    /**
     * Carrega as configurações.
     *
     * Se fornecido mais de um valor para $source, as configurações serão mescladas observada a ordem em que os arquivos estão nos parãmetros da função.
     *
     * Se houver conflito de configurações, a da ultima $source será utilizada.
     *
     * @param string $sources Lista de strings com as fontes de configuração. Usualmente caminhos para arquivos suportados ou DSN para conexão a bancos de dados (se suportado).
     * @return \ConfMgr\ConfigData Um objeto com as configurações carregadas.
     */
    public static function load(string ...$source): \ConfMgr\Config\ConfigRepoInterface {
        //armazena os dados recebidos do parser
        $config = [];
        
        //loop $sources
        foreach ($source as $source){
            //detecta o parser adequado
            $parser = self::dectectParser($source);
            //interpreta $source
            $data = $parser->parse();
            //mescla o resultado
            $config = array_merge($config, $data);
        }//fim loop $sources
        
        //retorna o armazém de configurações
        return new \ConfMgr\Config\ConfigRepo($config);
    }

    /**
     * Detecta qual parser é o adequado de acordo com o conteúdo de $source.
     * 
     * @param string $source
     * @return \ConfMgr\Parser\ParserInterface
     * @throws \UnexpectedValueException
     */
    protected static function dectectParser(string $source): \ConfMgr\Parser\ParserInterface
    {
        if(preg_match('/.\.ini$/i', $source) === 1){
            return new \ConfMgr\Parser\IniParser($source);
        }
        
        throw \UnexpectedValueException($source);
    }
}
