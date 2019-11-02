<?php
/**
 * Filippo Finke
 */

echo "Info:\nThis script is going to generate a SQL table and a model class automatically\n";
echo "[SQL] Table".PHP_EOL;
$table = readline("Table name: ");
$columns = array();
echo "[SQL] Columns [Press enter to continue]".PHP_EOL;
while(true) {
    $name = readline("> Name: ");
    if(empty($name)) break;
    $type = readline("> Type: ");
    $options = readline("> Options: ");
    $columns[] = array("name" => $name, "type" => $type, "options" => $options);
}

$sql = "CREATE TABLE $table (\n";
foreach($columns as $index => $column) {
    $name = $column["name"];
    $type = $column["type"];
    $options = $column["options"];
    if($options) $options = " ".$options;
    $sql .= "\t$name $type$options";
    if($index != count($columns) - 1) {
        $sql .= ",";
    }
    $sql .= "\n";
}
$sql .= ");";
if(!file_exists(__DIR__."/sql")) {
    mkdir(__DIR__."/sql");
}
$sqlPath = __DIR__."/sql/$table.sql";
file_put_contents($sqlPath, $sql);
echo "[SQL] Saved to $sqlPath".PHP_EOL;
echo "[Model] Generating model for table $table".PHP_EOL;
$id = readline("What is the key column?: ");
$model = "<?php
/**
 * Generated using the generator script
 * Filippo Finke
 */
namespace Models;
use Libs\Database;

class ".ucfirst($table)."
{\n";
$model .= '    public static function get() {
        $query = Database::get()->prepare("SELECT * FROM '.$table.'");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }';
$model .= "\n";
$model .= '    public static function getBy'.ucfirst($id).'($'.$id.') {
        $query = Database::get()->prepare("SELECT * FROM '.$table.' WHERE '.$id.' = :'.$id.'");
        $query->bindValue(":'.$id.'",$'.$id.');
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }';
$model .= "\n";
$args = "$".implode(",$", array_map(function ($entry) { return $entry['name']; }, $columns));
$bind = ":".implode(",:", array_map(function ($entry) { return $entry['name']; }, $columns));
$bindValues = "";
foreach($columns as $column) {
    $name = $column["name"];
    $bindValues .= '        $query->bindValue(":'.$name.'",$'.$name.');';
    $bindValues .= "\n";
}
$model .= '    public static function insert('.$args.') {
        $query = Database::get()->prepare("INSERT INTO '.$table.' VALUES ('.$bind.')");
'.$bindValues.'        return $query->execute();
    }';
$model .= "\n";
$args = "$".implode(",$", array_map(function ($entry) { return $entry['name']; }, $columns));
$bind = "";
foreach($columns as $index => $column) {
    $name = $column["name"];
    if($name == $id) continue;
    $bind .= "SET $name = :$name";
    if($index != count($columns) - 1) $bind .= ", ";
}
$bindValues = "";
foreach($columns as $column) {
    $name = $column["name"];
    if($name == $id) continue;
    $bindValues .= '        $query->bindValue(":'.$name.'",$'.$name.');';
    $bindValues .= "\n";
}
$model .= '    public static function update('.$args.') {
        $query = Database::get()->prepare("UPDATE '.$table.' '.$bind.' WHERE '.$id.' = :'.$id.'");
'.$bindValues.'        $query->bindValue(":'.$id.'",$'.$id.');
        return $query->execute();
    }';
$model .= "\n";
$model .= '    public static function delete($'.$id.') {
        $query = Database::get()->prepare("DELETE FROM '.$table.' WHERE '.$id.' = :'.$id.'");
        $query->bindValue(":'.$id.'",$'.$id.');
        return $query->execute();
    }';
$model .= "\n";
$model .= "}";

$modelPath = __DIR__."/application/models/".ucfirst($table).".php";
file_put_contents($modelPath, $model);
echo "[Model] Saved to $modelPath".PHP_EOL;