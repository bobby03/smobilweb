<div class="boxCont">
            <div id="contV3">
                
                <div id="vt1">
                    <div class="headerT">Cliente</div>
                </div>
                <div id="vc1" class="vbox">
                    <div class="left">
                        <p id="vtitulo">
                            <?php 
                            $flag = true;
                            $cliente = Clientes::model()->findByPk($pedidos['Solicitudes']['id_clientes']);

                            echo $cliente->nombre_empresa;?>
                        </p>
                        <p><span class="vresalta">RFC:</span> <?php echo $cliente->rfc;?></p>
                        <p><span class="vresalta">Contacto:</span> <?php echo $cliente->nombre_contacto.' '.$cliente->apellido_contacto;?></p>

                        <p><span class="vresalta">Domicilio de entrega:</span></br>
                        <?php echo ClientesDomicilio::model()->getDomicilio($data['destino']); ?></p>
                    </div>

                    
                    <div class="right">
                        <p><span class="vresalta">Fecha de salida:</span> <span class="fsalida"> </span></p>
                        
                        <p><span class="vresalta">Nombre de Tanque:</span><span class="ntan<?php echo $o?>"></span></p>
                    </div>
                   

                 </div>
                <div id="vt2">
                     <div class="headerT">Datos de la especie</div>
                </div>
                <div id="vc2">
                    <p><span class="vresalta">Especie:</span> <?php echo Especie::model()->getEspecie($data['especie']);?> </p>
                    <p><span class="vresalta">No. Organismos:</span> <?php echo $data['cantidad'];?></p>
                    <table id="vcont">
                        <tr class="pf">
                            <th class="pc"></th><th>Mínima</th><th>Máxima</th>
                        </tr>
                        <tr>
                            <?php $cepa=Cepa::model()->getCepa1($data['cepa']);?>
                            <th class="pc">Temperatura (Temp)</th><th><?php echo $cepa->temp_min ;?></th><th><?php echo $cepa->temp_max ;?></th>
                        </tr>
                        <tr>
                            <th class="pc">PH (ph)</th><th><?php echo $cepa->ph_min ;?></th><th><?php echo $cepa->ph_max ;?></th>
                        </tr>
                        <tr>
                            <th class="pc">Oxígeno (O)</th><th><?php echo $cepa->ox_min ;?></th><th><?php echo $cepa->ox_min ;?></th>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class='row buttons izq'>
            <?php 
            if($o==1){
                echo CHtml::submitButton('Finalizar');
            }
            ?>
            </div>
            
        </div>