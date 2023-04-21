<?php

namespace App\Controllers\Crud;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

use App\Controllers\Controller;

use App\Models\TableModel;

class CrudCreateController extends Controller
{
    private $class;
    private $namespace;
    private $name, $estructura, $nombreTabla;
    private $indent_1, $indent_2, $indent_3;

    public function __construct($ruta, $name, $estructura, $nombreTabla)
    {
        $this->class = new ClassType($name . 'Controller');
        $this->namespace = new PhpNamespace('App\Controllers\Admin');

        $this->name = $name;
        $this->estructura = $estructura;
        $this->nombreTabla = $nombreTabla;

        // sangrias
        $this->indent_1 = "\t";
        $this->indent_2 = "\t\t";
        $this->indent_3 = "\t\t\t";

        // namespace de la clase
        $this->namespace
            ->addUse(ResponseFactory::class)
            ->addUse(Guard::class)
            ->addUse(TableModel::class)
            ->addUse(Controller::class);
        $this->namespace->add($this->class);

        // extendiendo de Controller
        $this->class
            ->addComment("Class $name Controller")
            ->setExtends(Controller::class);

        // propiedades protegidas
        $this->class
            ->addProperty('permisos', [])
            ->setProtected();
        $this->class
            ->addProperty('responseFactory')
            ->setProtected();
        $this->class
            ->addProperty('guard')
            ->setProtected();
    }

    public function getBody()
    {
        // metodo constructor
        $this->methodConstruct();
        $this->methodIndex();
        $this->methodList();
        $this->methodStore();
        $this->methodSearch();
        $this->methodUpdate();
        $this->methodDelete();
        return "<?php \n\n" . $this->namespace;
    }

    private function methodConstruct()
    {
        // metodo contrusctor
        $methodConstruct = $this->class
            ->addMethod('__construct')
            ->addBody('parent::__construct();')
            ->addBody('$this->permisos = getPermisos($this->className($this));')
            ->addBody('$this->responseFactory = new ResponseFactory();')
            ->addBody('$this->guard = new Guard($this->responseFactory);');
        $methodConstruct
            ->addComment('Constructor de la clase');
    }

    private function methodIndex()
    {
        $js = strtolower("js/app/nw_" . $this->name . ".js");
        // metodo index
        $method = $this->class->addMethod('index');
        $method->addComment('Muestra la vista principal');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');
        $method
            ->addBody('return $this->render($response, ' . "'" . "App.$this->name.$this->name" . "'" . ', [')
            ->addBody($this->indent_1 . "'titulo_web' => " . "'$this->name',")
            ->addBody($this->indent_1 . "'url' => " . '$request->getUri()->getPath(),')
            ->addBody($this->indent_1 . "'permisos' => " . '$this->permisos,')
            ->addBody($this->indent_1 . "'js' => " . "['$js'],")
            ->addBody($this->indent_1 . "'tk' => [")
            ->addBody($this->indent_2 . "'name' => " . '$this->guard->getTokenNameKey(),')
            ->addBody($this->indent_2 . "'value' => " . '$this->guard->getTokenValueKey(),')
            ->addBody($this->indent_2 . "'key' => " . '$this->guard->generateToken(),')
            ->addBody($this->indent_1 . ']')
            ->addBody(']);');
    }

    private function methodList()
    {
        // metodo list
        $method = $this->class->addMethod('list');
        $method->addComment('Lista los datos de la tabla');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');
        $method
            ->addBody('$model = new TableModel;')
            ->addBody('$model->setTable("' . $this->nombreTabla . '");')
            ->addBody('$model->setId("' . $this->estructura[0] . '");')
            ->addBody("")
            ->addBody('$arrData = $model->orderBy("' . $this->estructura[0] . '", "DESC")->get();')
            ->addBody('$data = [];')
            ->addBody('$num = 0;')
            ->addBody("")
            ->addBody('for ($i = 0; $i < count($arrData); $i++) {')
            ->addBody("")
            ->addBody($this->indent_1 . '$btnDelete = "";')
            ->addBody($this->indent_1 . '$btnEdit = "";')
            ->addBody($this->indent_1 . '$num++;')
            ->addBody("")
            ->addBody($this->indent_1 . 'if ($this->permisos[' . "'perm_d'" . '] == 1) {')
            ->addBody($this->indent_2 . '$btnDelete = \'<a class="dropdown-item" href="javascript:fntDel(\' . $arrData[$i][\'' . $this->estructura[0] . '\'] . \');"><i class="bx bx-trash me-1"></i> Eliminar</a>\';')
            ->addBody($this->indent_1 . '}')
            ->addBody("")
            ->addBody($this->indent_1 . 'if ($this->permisos[' . "'perm_u'" . '] == 1) {')
            ->addBody($this->indent_2 . '$btnEdit = \'<a class="dropdown-item" href="javascript:fntEdit(\' . $arrData[$i][\'' . $this->estructura[0] . '\'] . \');"><i class="bx bx-edit-alt me-1"></i> Editar</a>\';')
            ->addBody($this->indent_1 . '}')
            ->addBody("")
            ->addBody($this->indent_1 . '$arrData[$i][\'options\'] = \'<div class="d-flex flex-row"><div class="ms-3 dropdown"><button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu">\' . $btnEdit . $btnDelete . \'</div></div></div>\';')
            ->addBody('}')
            ->addBody('return $this->respondWithJson($response, $arrData);');
    }

    private function methodStore()
    {
        // metodo apra guardar nuevo registro
        $method = $this->class->addMethod('store');
        $method->addComment('Metodo para guardar nuevo registro');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');

        // cuerpo del metodo
        $a = '';
        // for ($i=0; $i < ; $i++) { 
        //     # code...
        // }
        foreach (array_slice($this->estructura, 1) as $field) {
            $a .= $this->indent_1 . "'$field' => \$data['$field'],\n";
        }
        $a = substr($a, 0, -1);

        $method
            ->addBody('$data = $this->sanitize($request->getParsedBody());')
            ->addBody('// return $this->respondWithJson($response, $data);')
            ->addBody('')
            ->addBody('$validate = $this->guard->validateToken($data[\'csrf_name\'], $data[\'csrf_value\']);')
            ->addBody('if (!$validate) {')
            ->addBody($this->indent_1 . '$msg = "Error de validación, por favor recargue la página";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$errors = $this->validar($data);')
            ->addBody('if (!$errors) {')
            ->addBody($this->indent_1 . '$msg = "Verifique los datos ingresados";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$model = new TableModel;')
            ->addBody("\$model->setTable(\"$this->nombreTabla\");")
            ->addBody("\$model->setId(\"" . $this->estructura[0] . "\");")
            ->addBody("")
            ->addBody("/*\n" . '$existe = $model->where("field", "LIKE", $data[\'field\'])->first();')
            ->addBody('if (!empty($existe)) {')
            ->addBody($this->indent_1 . '$msg = "Ya tiene un usuario registrado con ese nombre";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody("}\n*/")
            ->addBody('')
            ->addBody('$rq = $model->create([')
            ->addBody($a)
            ->addBody(']);')
            ->addBody("")
            ->addBody('if (!empty($rq)) {')
            ->addBody($this->indent_1 . "\$msg = \"Datos guardados correctamente\";")
            ->addBody($this->indent_1 . "return \$this->respondWithSuccess(\$response, \$msg);")
            ->addBody('}')
            ->addBody("")
            ->addBody('$msg = "Error al guardar los datos";')
            ->addBody("")
            ->addBody('return $this->respondWithError($response, $msg);');

        // metodo validar
        $method = $this->class->addMethod('validar');
        $method->addComment('Metodo para verificar los datos');
        // parametros que recibe el metodo
        $method->addParameter('data');
        // cuerpo del metodo
        $a = '';
        foreach (array_slice($this->estructura, 1) as $field) {
            $a .= "if (empty(\$data['$field'])) {\n";
            $a .= $this->indent_1 . "return false;\n";
            $a .= "}\n";
            // $a .= $indent_1 . "'$field'=>\$data['$field'],\n";
        }
        $a .= "return true;";
        $method
            ->addBody($a);
    }

    private function methodSearch()
    {
        // metodo search
        $method = $this->class->addMethod('search');
        $method->addComment('Metodo para buscar un registro por el id');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');

        $method
            ->addBody('$data = $this->sanitize($request->getParsedBody());')
            ->addBody('// return $this->respondWithJson($response, $data);')
            ->addBody('')
            ->addBody('$errors = $this->validarSearch($data);')
            ->addBody('if (!$errors) {')
            ->addBody($this->indent_1 . '$msg = "Verifique los datos ingresados";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$model = new TableModel;')
            ->addBody("\$model->setTable(\"$this->nombreTabla\");")
            ->addBody("\$model->setId(\"" . $this->estructura[0] . "\");")
            ->addBody("")
            ->addBody("\$rq = \$model->find(\$data['" . $this->estructura[0] . "']);")
            ->addBody('if (!empty($rq)) {')
            ->addBody($this->indent_1 . 'return $this->respondWithJson($response, ["status" => true, "data" => $rq]);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$msg = "No se encontraron datos";')
            ->addBody('return $this->respondWithError($response, $msg);');


        // metodo validar search
        $method = $this->class->addMethod('validarSearch');
        $method->addComment('Metodo para verificar el campo de busqueda');
        // parametros que recibe el metodo
        $method->addParameter('data');
        $method
            ->addBody("if (empty(\$data['" . $this->estructura[0] . "'])) {")
            ->addBody($this->indent_1 . "return false;")
            ->addBody("}")
            ->addBody("return true;");
    }

    private function methodUpdate()
    {
        // metodo apra guardar nuevo registro
        $method = $this->class->addMethod('update');
        $method->addComment('Metodo para actualizar registro');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');

        // cuerpo del metodo
        $a = '';
        foreach (array_slice($this->estructura, 1) as $field) {
            $a .= $this->indent_1 . "'$field' => \$data['$field'],\n";
        }
        $a = substr($a, 0, -1);

        $method
            ->addBody('$data = $this->sanitize($request->getParsedBody());')
            ->addBody('// return $this->respondWithJson($response, $data);')
            ->addBody('')
            ->addBody('$validate = $this->guard->validateToken($data[\'csrf_name\'], $data[\'csrf_value\']);')
            ->addBody('if (!$validate) {')
            ->addBody($this->indent_1 . '$msg = "Error de validación, por favor recargue la página";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$errors = $this->validarUpdate($data);')
            ->addBody('if (!$errors) {')
            ->addBody($this->indent_1 . '$msg = "Verifique los datos ingresados";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody('}')
            ->addBody('')
            ->addBody('$model = new TableModel;')
            ->addBody("\$model->setTable(\"$this->nombreTabla\");")
            ->addBody("\$model->setId(\"" . $this->estructura[0] . "\");")
            ->addBody("")
            ->addBody("/*\n" . '$existe = $model->where("field", "LIKE", $data[\'field\'])->first();')
            ->addBody('if (!empty($existe)) {')
            ->addBody($this->indent_1 . '$msg = "Ya tiene un usuario registrado con ese nombre";')
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, $msg);')
            ->addBody("}\n*/")
            ->addBody('')
            ->addBody("\$rq = \$model->update(\$data['" . $this->estructura[0] . "'],[")
            ->addBody($a)
            ->addBody(']);')
            ->addBody("")
            ->addBody('if (!empty($rq)) {')
            ->addBody($this->indent_1 . "\$msg = \"Datos actualizados\";")
            ->addBody($this->indent_1 . "return \$this->respondWithSuccess(\$response, \$msg);")
            ->addBody('}')
            ->addBody("")
            ->addBody('$msg = "Error al guardar los datos";')
            ->addBody("")
            ->addBody('return $this->respondWithJson($response, $msg);');

        // metodo validar update
        $method = $this->class->addMethod('validarUpdate');
        $method->addComment('Metodo para verificar los datos por actualizar');
        // parametros que recibe el metodo
        $method->addParameter('data');
        // cuerpo del metodo
        $a = '';
        foreach ($this->estructura as $field) {
            $a .= "if (empty(\$data['$field'])) {\n";
            $a .= $this->indent_1 . "return false;\n";
            $a .= "}\n";
            // $a .= $indent_1 . "'$field'=>\$data['$field'],\n";
        }
        $a .= "return true;";
        $method
            ->addBody($a);
    }

    private function methodDelete()
    {
        // metodo para borrar registro
        $method = $this->class->addMethod('delete');
        $method->addComment('Metodo para eliminar registro por id');
        // parametros que recibe el metodo
        $method->addParameter('request');
        $method->addParameter('response');

        $method
            ->addBody('$data = $this->sanitize($request->getParsedBody());')
            ->addBody('// return $this->respondWithJson($response, $data);')
            ->addBody('')
            ->addBody("if (empty(\$data[\"" . $this->estructura[0] . "\"])) {")
            ->addBody($this->indent_1 . 'return $this->respondWithError($response, "Error de validación, por favor recargue la página");')
            ->addBody('}')
            ->addBody('')
            ->addBody('$model = new TableModel;')
            ->addBody("\$model->setTable(\"$this->nombreTabla\");")
            ->addBody("\$model->setId(\"" . $this->estructura[0] . "\");")
            ->addBody("")
            ->addBody("\$rq = \$model->find(\$data['" . $this->estructura[0] . "']);")
            ->addBody('if (!empty($rq)) {')
            ->addBody($this->indent_1 . "\$rq = \$model->delete(\$data[\"" . $this->estructura[0] . "\"]);")
            ->addBody($this->indent_1 . 'if (!empty($rq)) {')
            ->addBody($this->indent_2 . '$msg = "Datos eliminados correctamente";')
            ->addBody($this->indent_2 . 'return $this->respondWithSuccess($response, $msg);')
            ->addBody($this->indent_1 . '}')
            ->addBody('}')
            ->addBody('')
            ->addBody('$msg = "Error al eliminar los datos";')
            ->addBody('return $this->respondWithError($response, $msg);');
    }
}
