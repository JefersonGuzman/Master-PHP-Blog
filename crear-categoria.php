<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

  <!--Caja Principal -->
  <div id="principal">
    <h1>Crear categorias</h1>
    <p>
      Añade  nuevas categorias  al blog para que los usarios puedan usarlas al crear sus entradas
    </p>
    <br/>
    <form action="guardar-categorias.php" method="POST">
      <label for="nombre">Nombre de la Categoria</label>
      <input type="text" name="nombre"/>
      <input type="submit" value="Guardar">
    </form>
      
  </div>
  <!--FIN PRINCIPAL-->
<?php require_once 'includes/pie.php' ?>