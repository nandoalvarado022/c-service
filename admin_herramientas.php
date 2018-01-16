<?php 
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; ?>
<?php include "conex.php";?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include "header.php";?>
	</head>

	<body id="admin_herramientas">
		<div class="container">
			<header>
				<?php include "bienvenido.php";?>
			</header>

            <h3 style="margin: 20px 0 30px; text-align: center;">Administrador de <span class="label label-default">Herramientas</span></h3>

            <div class="panel panel-info" id="div_filtro"> 
                <div class="panel-heading"> 
                <h3 class="panel-title">Filtrar</h3>                 
                </div>
                <div class="panel-body"> 
                    <div class="input-group">
                        <span class="input-group-addon">Seleccione empresa</span>
                        <select class="form-control" name="" id="cmb_empresa_cliente">
                            <option value="">Cargando...</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <button class="btn btn-primary" onclick="editarItem()">Añadir item</button>
                    </div>
                    
                </div> 
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEditarItem" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id=""><span id="nombre_item" contenteditable=true></span></h4>
                </div>
                <div class="modal-body">
                    Cargando ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="editarItemCon()">Confirmar</button>
                </div>
                </div>
            </div>
            </div>

            <!-- listado herramientas -->
            <table class="table table-striped table-hover" id="tbl_listado_herramientas" border="1" align="center">
                <thead>
                    <tr class="info">
                        <th>ID</th>
                        <th>ITEM</th>
                        <th>CATEGORIA</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
		</div>

		<script>
        // script
        // definicion de variables
        var codigo_item;
        listado_herramientas();
        function listado_herramientas(){
            
            $("#tbl_listado_herramientas tbody").empty();
            $.ajax({
                url: "ajax.php",
                dataType: "json",
                data: {causa: "listado_herramientas", cmb_empresa_cliente: $("#div_filtro #cmb_empresa_cliente").val()},
                success: function(res){
                    
                    for (let index = 0; index < res.length; index++) {
                        row=JSON.parse(res[index]);
                        html=`
                        <tr>
                            <td>${row.item_hijo_id}</td>
                            <td>${row.nombre_hijo}</td>
                            <td>${row.nombre_padre}</td>
                            <td><button class="btn btn-default" id="" data-vlrunitario="${row.vlrunitario}" data-unidad="${row.unidad}" data-id-hijo="${row.item_hijo_id}" data-id-padre="${row.codigo}" data-nombre-hijo="${row.nombre_hijo}" data-cec="${row.codigo_cliente}" onclick=" editarItem(this)">Editar</button></td>
                        </tr>
                        `;
                            
                        $("#tbl_listado_herramientas tbody").append(html);
                    }

                    
                },
                error: function (request, status, error) {
                    console.log("Error: "+request.responseText);
                }
            })
        }

        function editarItem(element){
            $('#modalEditarItem .modal-body').html("Cargando...");
            $('#modalEditarItem').modal('show');
            if(typeof element=="undefined"){
                codigo_item="";
                data={
                    causa: "editar_item_listado_herramientas"
                };
                $('#modalEditarItem h4 span').html("Escriba aquí nombre del item");
            } else{ // edicion
                codigo_item=$(element).attr("data-id-hijo");
                data={
                    nombreHijo: $(element).attr("data-nombre-hijo"),
                    causa: "editar_item_listado_herramientas",
                    vlrunitario: $(element).attr("data-vlrunitario"),
                    unidad: $(element).attr("data-unidad"),
                    codigo_padre: $(element).attr("data-id-padre"),
                    cec: $(element).attr("data-cec")                    
                }
                
                $('#modalEditarItem h4 span').html(data.nombreHijo);
            }

            $.ajax({
                url: "ajax.php",
                data: data,
                success: function(res){
                    $('#modalEditarItem .modal-body').html(res);
                }
            })            
        }

        function editarItemCon(){ // confirmar edición
            $.ajax({
                url: "ajax.php",
                data: {
                    causa: "editarItemCon",
                    codigo_item: codigo_item,
                    nombre: nombre_item.innerHTML,
                    unidad: unidad.value,
                    vlrunitario: inpPrecio.value,
                    codigo_padre: cmb_codigo_padre.value,
                    cec: $("#modalEditarItem  #cmb_empresa_cliente").val()
                },
                success: function(res){
                    alert(res);
                    
                    $('#modalEditarItem').modal('hide');
                    listado_herramientas();
                }
            })
        }

        // cargando combo empresa cliente
            $.ajax({
                url: "ajax.php",
                data: {
                    causa: "cmb_empresa_cliente"
                },
                success: function(res){
                    cmb_empresa_cliente.innerHTML = res;
                    // $("#cmb_empresa_cliente").change(listado_herramientas());

                    cmb_empresa_cliente.addEventListener("change", function() {
                        listado_herramientas()
                        // alert();
                    });
                }
            })            
        </script>
	</body>
</html>