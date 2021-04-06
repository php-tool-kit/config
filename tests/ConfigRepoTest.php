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

namespace ConfMgr\Test;
/**
 * Description of ConfLoaderTest
 *
 * @author Everton
 */
class ConfigRepoTest extends \PHPUnit\Framework\TestCase {
    use TestToolTrait;
    
    public function testGetMethodSuccess(): void
    {
        $config = \ConfMgr\Loader\ConfigLoader::load($this->iniFile);
        $this->assertEquals('root', $config->get('user.name'));
    }
    
    public function testGetMagicMethodSuccess(): void
    {
        $config = \ConfMgr\Loader\ConfigLoader::load($this->iniFile);
        $this->assertEquals('root', $config->{'user.name'});
    }
    
    public function testListMethodSuccess(): void
    {
        $config = \ConfMgr\Loader\ConfigLoader::load($this->iniFile);
        $this->assertIsArray($config->list());
        $this->assertEquals($this->iniConfig, $config->list());
    }
}
