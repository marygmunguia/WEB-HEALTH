//IMPRIMIR DIAGNOSTICO
$(".IMP").on("click", ".btnImprimirDiagnostico", function () {

    var idcitamedica = $(this).attr("idcitamedica");

    window.open("extension/TCPDF-main/examples/diagnostico.php?idcitamedica="+idcitamedica,"_black");

});

//IMPRIMIR LISTADO DE ESPECIALIDADES

$(".ImprimirEspecialidades").on("click", function(){        

    window.open("extension/TCPDF-main/examples/especialidades.php","_black");

});                                


//IMPRIMIR LISTADO DE MEDICOS POR ESPECIALIDADES

$(".ImprimirMedicoEspecialidades").on("click", function(){        

    window.open("extension/TCPDF-main/examples/medico-especialidad.php","_black");

});         

//IMPRIMIR LISTADO DE MEDICOS POR ESPECIALIDADES

$(".NuevosUsuarios").on("click", function(){        

    window.open("extension/TCPDF-main/examples/nuevos-usuarios.php","_black");

});                                