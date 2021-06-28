<?php


$col2 = '<br/><div id="'.Utils::rand10().'" class="row" onClick="onClickRow(this)"><div class="col-md-6 col-sm-12">col-1<br/></div><div class="col-md-6 col-sm-12">col-2<br/></div><br/></div></br>';
$col3 = '<br/><div id="'.Utils::rand10().'" class="row" onClick="onClickRow(this)"><div class="col-md-4 col-sm-12">col-1<br/></div><div class="col-md-4 col-sm-12">col-2<br/></div><div class="col-md-4 col-sm-12">col-3<br/></div></div><br/>';
$col4 = '<br/><div id="'.Utils::rand10().'" class="row" onClick="onClickRow(this)"><div class="col-md-3 col-sm-12">col-1<br/></div><div class="col-md-3 col-sm-12">col-2<br/></div><div class="col-md-3 col-sm-12">col-3<br/></div><div class="col-md-3 col-sm-12">col-4<br/></div></div><br/>';
$col6 = '<br/><div id="'.Utils::rand10().'" class="row" onClick="onClickRow(this)"><div class="col-md-2 col-sm-6">col-1<br/></div><div class="col-md-2 col-sm-6">col-2<br/></div><div class="col-md-2 col-sm-6">col-3<br/></div><div class="col-md-2 col-sm-6">col-4<br/></div><div class="col-md-2 col-sm-6">col-5<br/></div><div class="col-md-2 col-sm-6">col-6<br/></div></div><br/>';
$col8 = '<br/><div id="'.Utils::rand10().'" class="row" onClick="onClickRow(this)"><div class="col">col-1<br/></div><div class="col">col-2<br/></div><div class="col">col-3<br/></div><div class="col">col-4<br/></div><div class="col">col-5<br/></div><div class="col">col-6<br/></div><div class="col">col-7<br/></div><div class="col">col-8<br/></div></div><br/>';

$cols = array( 0 => $col2 , 1 => $col3, 2 => $col4, 3 => $col6, 4 => $col8 );

?>
<style>

#insertColumnModal > * > * > * > * > * > * {
  border: 1px dotted red;
}

#insertColumnModal > * > * > * > * > * > * > * {
  border: 1px dotted blue;
}

</style>

		<button type="button" class="btn btn-link btn-icon" data-bs-toggle="modal" data-bs-target="#insertColumnModal">
          <span class="material-icons md-36 blue">view_column</span>
        </button>


        <!-- Modal -->
        <div class="modal fade" id="insertColumnModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Click on a row of columns to insert:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               <p>To insert a row of columns place your cursor on the page and then click on the desired row.</p>
               <div class="row  gx-1 gy-1">
                	<div class="col-12">
                	   Text align: <select onchange="setRowAlignment(this[this.selectedIndex].value)">
                				<option value="start" selected>start</option>
                				<option value="center">center</option>
                				<option value="end">end</option>
                			</select>

                	</div>
                </div>
                <div class="row  gx-1 gy-1">
                	<div class="col-12">

                        <?php
                            foreach($cols as $c){
                                echo $c;
                            }
                        ?>

                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <script>
			function setRowAlignment(align){
				$('[class*="col"]').css('text-align', align);
			}

			function onClickRow(e){
				console.log(e);
				console.log(e.id);
				console.log($(e).attr("class"));
				console.log(e.children);
				insertAtCursor(e.outerHTML);
			}
        </script>