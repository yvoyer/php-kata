<?php

namespace spec\Star\Kata\Model\Step;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\ClassTemplate;

class CreateClassStepSpec extends ObjectBehavior
{
    /**
     * @var VfsStreamDirectory
     */
    private $root;

    /**
     * @var ClassTemplate
     */
    private $template;

    /**
     * @var string
     */
    private $content;

    function let(ClassTemplate $template, Configuration $config)
    {
        $this->template = $template;
        $this->root = vfsStream::setup('src');
        $this->template->getClassName()->willReturn('Path\To\CreateClass');
        $this->content = <<<CONTENT
<?php

namespace Path\To;

class CreateClass
{
}
CONTENT;

        $this->template->getContent()->willReturn($this->content);
        $config->getSrcPath()->willReturn(vfsStream::url('src'));
        $this->beConstructedWith($config, $this->template);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Step\CreateClassStep');
    }

    function it_is_a_step()
    {
        $this->shouldHaveType('Star\Kata\Model\Step\Step');
    }

    function  it_create_a_file()
    {
        assertFalse($this->root->hasChild('src/Path/To/CreateClass.php'), 'Should not have the file');
        $this->init();
        assertTrue($this->root->hasChild('src/Path/To/CreateClass.php'), 'Should create class file');

        $expectedPaths = array('src' => array('Path' => array('To' => array('CreateClass.php' => $this->content))));
        $actualPaths = vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure();

        assertEquals($expectedPaths, $actualPaths, 'Structure is not valid');
    }
}
