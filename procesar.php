<?php
// Clase Nodo
class Nodo {
  public $valor;
  public $hijos;

  public function __construct($valor) {
    $this->valor = $valor;
    $this->hijos = array();
  }

  public function agregarHijo($nodo) {
    $this->hijos[] = $nodo;
  }
}

function buscarNodo($nodo, $valor) { //recorrido por anchura
  $cola = []; // Cola para almacenar los nodos a visitar

  // Agregar el nodo raíz a la cola
  array_push($cola, $nodo);

  // Recorrer la cola hasta que esté vacía
  while (!empty($cola)) {
      $nodoActual = array_shift($cola); // Obtener el primer nodo de la cola

      if ($nodoActual->valor == $valor) {
          return $nodoActual; // Se encontró el nodo con el valor buscado
      }

      // Agregar los hijos del nodo actual a la cola
      foreach ($nodoActual->hijos as $hijo) {
          array_push($cola, $hijo);
      }
  }

  return null; // No se encontró el nodo con el valor buscado
}

function esAncestro($nodo, $valor) {
  $cola = new SplQueue();
  $cola->enqueue($nodo);

  while (!$cola->isEmpty()) {
    $nodoActual = $cola->dequeue();

    if ($nodoActual->valor === $valor) {
      return "yes";
    }

    foreach ($nodoActual->hijos as $hijo) {
      $cola->enqueue($hijo);
    }
  }

  return null;
}   

// Obtener el input ingresado
$input = $_POST['input'];


// Dividir el input en líneas individuales
$lineas = explode("\n", $input);

// Obtener el valor de n (la cantidad de nodos) y Q (la cantidad de consultas)
$nq = explode(" ", $lineas[0]); // uso explode para ceparar por espacio
$n = (int) $nq[0]; //casteo como numero
$q = (int) $nq[1];// casteo como numero

// creo el arbol o el primer nodo
$raiz = null;

//recorro las lineas siguientes 
for($i = 1; $i <= $n-1; $i++){
  $uv = explode(" ",$lineas[$i]);
  $u = (int) $uv[0];
  $v = (int) $uv[1];

  if($u == 1){
    $raiz = new Nodo(1);
    $nodo = new Nodo($v);

    $raiz->agregarHijo($nodo);

  }else{

    $nodoPadre = buscarNodo($raiz,$u);
    $nodoHijo =new Nodo($v);
    $nodoPadre->agregarHijo($nodoHijo);
    
  }

}

//consultas

for($i=$n ; $i <= $n+$q-1 ; $i++){
  $uv = explode(" ",$lineas[$i]);
  $u = (int) $uv[0];
  $v = (int) $uv[1];

    // Verificar si u es antecesor de v
    $resultado = 'No';
    if ($u === $v || esAncestro(buscarNodo($raiz,$u), $v)) {
      $resultado = 'Yes';
    }
  
    // Almacenar el resultado
    $resultados[] = "Consulta " . ($i-$n+1) . ": $resultado";

}
header("Location: index.php?output=" . urlencode(implode('<br>', $resultados)));
exit;



?>
