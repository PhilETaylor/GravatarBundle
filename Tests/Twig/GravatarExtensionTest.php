<?php

namespace Ornicar\GravatarBundle\Tests\Twig;

use Ornicar\GravatarBundle\Templating\Helper\GravatarHelperInterface;
use Ornicar\GravatarBundle\Twig\GravatarExtension;
use PHPUnit\Framework\TestCase;

class GravatarExtensionTest extends TestCase
{
    /**
     * @var GravatarHelperInterface
     */
    private $helper;

    /**
     * @var GravatarExtension
     */
    private $extension;

    public function setUp()
    {
        $this->helper = $this->createMock('Ornicar\GravatarBundle\Templating\Helper\GravatarHelperInterface');
        $this->extension = new GravatarExtension($this->helper);
    }

    public function testProxyMethods()
    {
        $this->helper->expects($this->any())->method('getUrl');
        $this->helper->expects($this->any())->method('getUrlForHash');
        $this->helper->expects($this->any())->method('exists');

        $this->extension->getUrl('henrik@bjrnskov.dk');
        $this->extension->exists('henrik@bjrnskov.dk');
        $this->extension->getUrlForHash(md5('henrik@bjrnskov.dk'));
        $this->extension->getProfileUrl('henrik@bjrnskov.dk');
        $this->extension->getProfileUrlForHash(md5('henrik@bjrnskov.dk'));
    }

    public function testName()
    {
        $this->assertEquals('ornicar_gravatar', $this->extension->getName());
    }

    public function testFunctions()
    {
        $this->assertContainsOnlyInstancesOf('\Twig\TwigFunction', $this->extension->getFunctions());

        $expectedNames = array(
            'gravatar',
            'gravatar_hash',
            'gravatar_profile',
            'gravatar_profile_hash',
            'gravatar_exists',
        );

        $functions = $this->extension->getFunctions();
        foreach ($expectedNames as $n => $expectedName) {
            $this->assertSame($expectedName, $functions[$n]->getName());
        }
    }
}
