    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reportes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="principal-admin">Home</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php

    include 'reportes/resumen.php';

    ?>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    include 'reportes/grafica1.php';
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    include 'reportes/grafica3.php';
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    include 'reportes/grafica2.php';
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    include 'reportes/grafica4.php';
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                   // include 'reportes/grafica5.php';
                    ?>
                </div>
            </div>
        </div>
    </section>