<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-11-12
 * Time: 19:14
 */
namespace app\common\bean\builder;

use app\common\bean\BaseBean;
use app\common\bean\ListMap;
use app\common\exception\ParameterException;
use app\common\utils\ExceptionUtils;

/**
 * Bean生成类文件
 * Class BeanManager
 * @package app\common\bean
 */
class BeanManager
{

    private $beanBean = null;

    public function __construct() {
        $type = config("database.type");
        switch ($type) {
            case "mysql":
                $this->beanBean = Mysql::getInstance();
                break;
            case "sqlsrv":
                $this->beanBean = Sqlsrv::getInstance();
                break;
            case "pgsql":
                $this->beanBean = Pgsql::getInstance();
                break;
            default:
                ExceptionUtils::throwMyException(new ParameterException());
                break;
        }
    }

    /**
     * table参数接收
     */
    public function assemblyTable($tableName) {
        $tables = $this->beanBean->getAllTable();
        if (!in_array($tableName, $tables->getData())) {
            return 'error - table not exit';
        } else {
            $ROOT_PATH = dirname(dirname(dirname(dirname(__FILE__))));
            $this->creatBean($tableName, $ROOT_PATH);
            $this->creatManage($tableName, $ROOT_PATH);
            $this->creatModel($tableName, $ROOT_PATH);
            $this->creatValidate($tableName, $ROOT_PATH);
            $this->creatEnum($tableName,$ROOT_PATH);
            return 'success';
        }
    }

    /**创建Bean
     * @param $tableName
     * @param $ROOT_PATH
     * @return bool
     */
    private function creatBean($tableName, $ROOT_PATH) {
        $columns = $this->beanBean->getTableColumn($tableName);
        $commonBeanRoot = $ROOT_PATH."/common/bean/";//bean类存放的文件夹
        $baseBeanFile = $commonBeanRoot."BaseBean.php";
        if (!file_exists($baseBeanFile)) {//若不存在基础类则新建基础Bean类
            $baseBean = file_get_contents("../BaseBean.php");
            file_put_contents($baseBeanFile, $baseBean);//基础bean类
        }
        $appNamespace = config("app_namespace", 'app');//获取命名空间开头  app
        $fileName = $this->getFileName($tableName);
        $fileRoot = $commonBeanRoot.$fileName.".php";
        $content = "<?php\n/*由bean脚本生成 powerBy--Reer*/\n\n";//php脚本开头 及注释
        $content .= "namespace {$appNamespace}\common\bean;\n\n";//命名空间
        $content .= "class {$fileName} extends BaseBean\n{\n";//类名及基层基础Bean类
        $content .= $this->assemblyParams($columns);
        $content .= "\tstatic \$tableName = '".str_replace(config("database.prefix"), "", $tableName)."';\n";
        $content .= "\tstatic \$alias = '{$fileName}';";
        $content .= "\n\n";
        $content .= $this->assemblyGetSet($columns);
        $content .= "}";
        file_put_contents($fileRoot, $content);
        return true;
    }

    /** 创建manage
     * @param $tableName
     * @param $ROOT_PATH
     * @return bool
     */
    private function creatManage($tableName, $ROOT_PATH) {
        $commonBeanRoot = $ROOT_PATH."/common/manage/";//manage类存放的文件夹
        $appNamespace = config("app_namespace", 'app');//获取命名空间开头  app
        $fileName = $this->getFileName($tableName, 'Manage');
        $fileRoot = $commonBeanRoot.$fileName.".php";
        if (is_file($fileRoot))
            return false;
        $content = "<?php\n/*由脚本生成 powerBy--Reer*/\n\n";//php脚本开头 及注释
        $content .= "namespace {$appNamespace}\common\manage;\n\n";//命名空间
        $content .= "class {$fileName} extends BaseManage\n{\n";//
        $content .= "\tprotected static \$_self = null;\n";
        $content .= "\tstatic function getInstance(){\n";
        $content .= "\t\tif(empty(self::\$_self)){\n";
        $content .= "\t\t\tself::\$_self = new {$fileName}();\n";
        $content .= "\t\t}\n";
        $content .= "\t\treturn self::\$_self;\n";
        $content .= "\t}\n";
        $content .= "}";
        file_put_contents($fileRoot, $content);
        return true;
    }

    /** 创建model
     * @param $tableName
     * @param $ROOT_PATH
     * @return bool
     */
    private function creatModel($tableName, $ROOT_PATH) {
        $commonBeanRoot = $ROOT_PATH."/common/model/";//model类存放的文件夹
        $appNamespace = config("app_namespace", 'app');//获取命名空间开头  app
        $fileName = $this->getFileName($tableName, 'Model');
        $fileRoot = $commonBeanRoot.$fileName.".php";
        if (is_file($fileRoot))
            return false;
        $content = "<?php\n/*由脚本生成 powerBy--Reer*/\n\n";//php脚本开头 及注释
        $content .= "namespace {$appNamespace}\common\model;\n\n";//命名空间
        $content .= "class {$fileName} extends BaseModel\n{\n";//
        $content .= "\tprotected \$table = '{$tableName}';\n";
        $content .= "\tprotected static \$_self = null;\n";
        $content .= "\tstatic function getInstance(){\n";
        $content .= "\t\tif(empty(self::\$_self)){\n";
        $content .= "\t\t\tself::\$_self = new {$fileName}();\n";
        $content .= "\t\t}\n";
        $content .= "\t\treturn self::\$_self;\n";
        $content .= "\t}\n";
        $content .= "}";
        file_put_contents($fileRoot, $content);
        return true;

    }

    /** 创建validate
     * @param $tableName
     * @param $ROOT_PATH
     * @return bool
     */
    private function creatValidate($tableName, $ROOT_PATH) {
        $commonBeanRoot = $ROOT_PATH."/common/validate/";//model类存放的文件夹
        $appNamespace = config("app_namespace", 'app');//获取命名空间开头  app
        $fileName = $this->getFileName($tableName, 'Validate');
        $beanName = $this->getFileName($tableName);
        $columns = $this->beanBean->getTableColumn($tableName);
        $baseValidateFile = $commonBeanRoot."BaseValidate.php";
        if (!file_exists($baseValidateFile)) {//若不存在基础类则新建基础Bean类
            $baseBean = file_get_contents("BaseValidate.php");
            file_put_contents($baseValidateFile, $baseBean);//基础bean类
        }

        $fileRoot = $commonBeanRoot.$fileName.".php";
        if (is_file($fileRoot))
            return false;
        $content = "<?php\n/*由bean脚本生成 powerBy--Joee*/\n\n";//php脚本开头 及注释
        $content .= "namespace {$appNamespace}\\common\\validate;\n\n";//命名空间
        $content .= "use app\\common\\bean\\{$beanName};\n\n";//命名空间

        $content .= "class {$fileName} extends BaseValidate\n{\n";//类名及基层基础Bean类
        $content .= $this->validateFileds($columns, $beanName);
        $content .= "\n\n";
        $content .= "}";
        file_put_contents($fileRoot, $content);
        return true;
    }

    /** 获取对应后缀文件名
     * @param        $tableName
     * @param string $suffix
     * @return string
     */
    private function getFileName($tableName, $suffix = "Bean") {
        $prefix = config("database.prefix");
        $fileArray = explode("_", $tableName);
        $fileName = '';
        if (!empty($prefix)) {
            foreach ($fileArray as $key => $value) {
                if ($key != 0) {
                    $fileName .= ucfirst($value);
                }
            }
        } else {
            foreach ($fileArray as $key => $value) {
                $fileName .= ucfirst($value);
            }
        }
        $fileName = $fileName.$suffix; //bean 文件名
        return $fileName;
    }

    /** 参数组装  protected $id = "id"; //主键
     * @param ListMap $columns
     * @return string
     */
    private function assemblyParams(ListMap $columns) {
        $content = '';
        $baseBean = new BaseBean();
        foreach ($columns->getList() as $item) {//组装好所有变量
            $baseBean->setData($item);
            $fieldName = $baseBean->getParameter("COLUMN_NAME");
            $param = '';//变量名
            $fieldNameArray = explode("_", $fieldName);
            foreach ($fieldNameArray as $key => $value) {
                if ($key == 0) {
                    $param = $fieldNameArray[$key];
                } else {
                    $param .= ucfirst($fieldNameArray[$key]);
                }
            }
            $content .= "\tstatic \${$param} = '{$fieldName}'; //{$baseBean->getParameter('COLUMN_COMMENT')}\n";
        }
        return $content;
    }

    /**组装get、set函数
     * @param ListMap $columns
     * @return string
     */
    private function assemblyGetSet(ListMap $columns) {
        $content = '';
        $baseBean = new BaseBean();
        foreach ($columns->getList() as $item) {
            $baseBean->setData($item);
            $fieldName = $baseBean->getParameter("COLUMN_NAME");
            $param = '';
            $fieldNameArray = explode("_", $fieldName);
            foreach ($fieldNameArray as $key => $value) {
                if ($key == 0) {
                    $param = $fieldNameArray[$key];
                } else {
                    $param .= ucfirst($fieldNameArray[$key]);
                }
            }
            $functionParam = ucfirst($param); //get 、set 后面字母大写
            $content .= "\tpublic function get{$functionParam}(){\n\t\treturn \$this->getParameter(self::\${$param});\n\t}\n\n";
            $content .= "\tpublic function set{$functionParam}(\${$param}){\n\t\t\$this->setParameter('{$fieldName}',\${$param});\n\t}\n\n";
        }
        return $content;
    }

    /**验证参数封装  protected $id = "id"; //主键
     * @param ListMap $columns
     * @return string
     */
    private function validateFileds(ListMap $columns, $beanName) {
        $content = '';
        $content .= "\tpublic function __construct(array \$rules = [], array \$message = [], array \$field = [])\n\t{\n";
        $content .= "\t\tparent::__construct(\$rules, \$message, \$field);\n\n";
        $content .= "\t\t\$this->rule = [\n";

        $baseBean = new BaseBean();
        foreach ($columns->getList() as $item) {//组装好所有变量
            $baseBean->setData($item);
            $fieldName = $baseBean->getParameter("COLUMN_NAME");
            $param = '';//变量名
            $fieldNameArray = explode("_", $fieldName);
            foreach ($fieldNameArray as $key => $value) {
                if ($key == 0) {
                    $param = $fieldNameArray[$key];
                } else {
                    $param .= ucfirst($fieldNameArray[$key]);
                }
            }
            $content .= "\t\t\t {$beanName}::\${$param} => 'require', //{$baseBean->getParameter('COLUMN_COMMENT')}\n";
        }
        $content .= "\t\t];\n";

        $content .= "\t\t\$this->message = [\n";
        $baseBean = new BaseBean();
        foreach ($columns->getList() as $item) {//组装好所有变量
            $baseBean->setData($item);
            $fieldName = $baseBean->getParameter("COLUMN_NAME");
            $param = '';//变量名
            $fieldNameArray = explode("_", $fieldName);
            foreach ($fieldNameArray as $key => $value) {
                if ($key == 0) {
                    $param = $fieldNameArray[$key];
                } else {
                    $param .= ucfirst($fieldNameArray[$key]);
                }
            }
            $content .= "\t\t\t {$beanName}::\${$param} => '{$fieldName}必须', //{$baseBean->getParameter('COLUMN_COMMENT')}\n";
        }
        $content .= "\t\t];\n";

        $content .= "\t\t\$this->scene = [\n";
        $baseBean = new BaseBean();
        $content .= "\t\t\t'all' => [";
        foreach ($columns->getList() as $item) {//组装好所有变量
            $baseBean->setData($item);
            $fieldName = $baseBean->getParameter("COLUMN_NAME");
            $param = '';//变量名
            $fieldNameArray = explode("_", $fieldName);
            foreach ($fieldNameArray as $key => $value) {
                if ($key == 0) {
                    $param = $fieldNameArray[$key];
                } else {
                    $param .= ucfirst($fieldNameArray[$key]);
                }
            }
            $content .= "{$beanName}::\${$param},";
        }
        $content .= "],\n";
        $content .= "\t\t];\n";
        $content .= "\t}\n";
        return $content;
    }

    /**创建枚举类
     * @param $tableName
     * @param $ROOT_PATH
     * @return bool
     */
    private function creatEnum($tableName,$ROOT_PATH){
        $columns = $this->beanBean->getTableColumn($tableName);
        $commonBeanRoot = $ROOT_PATH."/common/enum/";//bean类存放的文件夹
        $appNamespace = config("app_namespace", 'app');//获取命名空间开头  app
        foreach ($columns->getList() as $item){
            $fieldName = $item['TABLE_NAME']."_".$item['COLUMN_NAME'];
            $fileName = $this->getFileName($fieldName,'Enum');
            $fileRoot = $commonBeanRoot.$fileName.".php";
            if($item['DATA_TYPE'] == 'tinyint' && !file_exists($fileRoot)){
                $content = "<?php\n/*由bean脚本生成 powerBy--Reer*/\n\n";//php脚本开头 及注释
                $content .= "namespace {$appNamespace}\\common\\enum;\n\n";//命名空间
                $content .= "class {$fileName} implements BaseEnum\n{\n";//类名及基层基础Bean类
                $content .= "\n\n";
                $content .= "}";
                file_put_contents($fileRoot, $content);
            }
        }
        return true;
    }
}