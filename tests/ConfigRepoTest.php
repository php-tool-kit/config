<?php declare(strict_types=1);

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

namespace PTK\Config\Test;

use PTK\Config\Loader\ConfigLoader;
use PTK\Config\Test\TestToolTrait;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

/**
 * Description of ConfLoaderTest
 *
 * @author Everton
 */
class ConfigRepoTest extends TestCase {
    use TestToolTrait;
    
    public function testGetMethodSuccess(): void
    {
        $config = ConfigLoader::load($this->iniFile);
        $this->assertEquals('root', $config->get('user.name'));
    }
    
    public function testGetMagicMethodSuccess(): void
    {
        $config = ConfigLoader::load($this->iniFile);
        $this->assertEquals('root', $config->{'user.name'});
    }
    
    public function testUnexpectedKey(): void
    {
        $config = ConfigLoader::load($this->iniFile);
        $this->expectException(UnexpectedValueException::class);
        $config->get('unknow.key');
    }
    
    public function testListMethodSuccess(): void
    {
        $config = ConfigLoader::load($this->iniFile);
        $this->assertIsArray($config->list());
        $this->assertEquals($this->iniConfig, $config->list());
    }
    
}
