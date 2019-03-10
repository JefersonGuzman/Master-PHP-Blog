<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
        <!--Caja Principal -->
        <div id="principal">
            <h1>Ultimas entradas</h1>
            <?php 
                $entradas = conseguirEntradas($db,true);
                               
                    while($entrada = mysqli_fetch_assoc($entradas)):

            ?>
            <article class="entrada">
                <a href="entradas.php?id=<?=$entrada['id']?>">    
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?= $entrada['categoria'].'  |  '.$entrada['fecha'] ?></span>
                        <p>
                            <?= substr( $entrada['descripcion'], 0, 180)."..."?>
                        </p>
                </a>
            </article>
            <?php
                    endwhile;
               
            ?>
            <div id="ver-todas">
                <a href="entradas.php">Ver todas las entradas</a>
            </div>
            </article>
        </div><!--FIN PRINCIPAL-->



<?php require_once 'includes/pie.php' ?>
    </body>
</html>
