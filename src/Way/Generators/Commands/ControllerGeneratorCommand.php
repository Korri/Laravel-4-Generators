<?php namespace Way\Generators\Commands;

use Way\Generators\Generators\ControllerGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Way\Generators\NameParser;

class ControllerGeneratorCommand extends BaseGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new controller.';

    /**
     * Model generator instance.
     *
     * @var \Way\Generators\Generators\ControllerGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     * @param ControllerGenerator $generator
     */
    public function __construct(ControllerGenerator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Get the path to the file that should be generated.
     *
     * @param NameParser $nameparser
     * @return string
     */
    protected function getPath(NameParser $nameparser)
    {
        $this->generator->setViewsSubfolder($nameparser->get('dirname'));
        return $this->option('path') . '/' . $nameparser->get('dirname') . '/' . ucfirst($nameparser->get('basename')) . 'Controller.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the controller to generate.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
           array('path', null, InputOption::VALUE_OPTIONAL, 'Path to controllers directory.', app_path() . '/controllers'),
           array('template', null, InputOption::VALUE_OPTIONAL, 'Path to template.', __DIR__.'/../Generators/templates/controller.txt'),
        );
    }
}