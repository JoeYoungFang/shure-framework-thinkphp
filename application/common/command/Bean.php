<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-11-12
 * Time: 18:55
 */

namespace app\common\command;


use app\common\bean\builder\BeanManager;
use Exception;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

/**
 * 生成bean的命令行
 * Class Bean
 * @package app\common\command
 */
class Bean extends Command
{
    protected function configure() {
        $this->setName('hello')
            ->addArgument('tableName', Argument::OPTIONAL, "your name")
            ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('Say Bean');
    }

    protected function execute(Input $input, Output $output) {
        $tableName = trim($input->getArgument('tableName'));
        $beanManager = new BeanManager();
        try{
            $result = $beanManager->assemblyTable($tableName);
            $output->writeln("The Result：".$result);
        }catch (Exception $exception){
            $output->writeln("Exception：".$exception->getMessage());
        }
    }
}