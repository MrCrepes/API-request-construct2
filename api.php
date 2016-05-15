<?php 
/*
**  Auteur: HUGON Bastien
**  
**                                             API V 1.0.5
**                                          Maison Domotique
**                   
**
*/
    try
    {
        $bdd = new PDO('mysql:host=37.59.99.171;dbname=maison_domotique;charset=utf8', 'root', '191265Baba');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
        die('Error : ' . $e->getMessage());
    }

    if(empty($_GET)){
        echo '{ <br><div style="text-indent: 15px;">State: ERROR,</div><div style="text-indent: 15px;">No action launched...</div><br>}';
    }elseif(isset($_GET['name']) && isset($_GET['state'])){
        if(!isset($_GET['name']) OR !isset($_GET['state'])){
            echo '{ <br><div style="text-indent: 15px;">"State": Error</div><div style="text-indent: 15px;">"Missing": <b>name or state</b></div>}';
        }else{
            /*
            **
            **          Écriture de la valeur de la requête dans la Database
            **
            */

            if(strtolower($_GET['name']) == "portail"){
                if($_GET['state'] == "0" || $_GET['state'] == "1"){
                    $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'portail'");
                    $req->execute(array(':state' => $_GET['state']));
                    echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to '.$_GET['state'].'</div>}';
                }elseif($_GET['state'] == "toggle"){
                    $state = $bdd->query("SELECT state FROM commandes WHERE name = 'portail'");
                    $state = $state->fetch();
                    if($state['state'] == "1"){
                        $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'portail'");
                        $req->execute(array(':state' => "0"));  
                        echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to 0</div>}';
                    }else{
                        $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'portail'");
                        $req->execute(array(':state' => "1"));
                        echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to 1</div>}';                          
                    }
                }else{
                    echo '{ <br><div style="text-indent: 15px;">"State": Error</div><div style="text-indent: 15px;">"Bad argument": <b>STATE</b></div>}';
                }  
            }elseif(strtolower($_GET['name']) == "store"){
                if($_GET['state'] == "0" || $_GET['state'] == "1"){
                    $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'store'");
                    $req->execute(array(':state' => $_GET['state']));
                    echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to '.$_GET['state'].'</div>}';
                }elseif($_GET['state'] == "toggle"){
                    $state = $bdd->query("SELECT state FROM commandes WHERE name = 'store'");
                    $state = $state->fetch();
                    if($state['state'] == "1"){
                        $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'store'");
                        $req->execute(array(':state' => "0"));  
                        echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to 0</div>}';
                    }else{
                        $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'store'");
                        $req->execute(array(':state' => "1"));
                        echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": '.strtolower($_GET['name']).' set to 1</div>}';                          
                    }
                }else{
                    echo '{ <br><div style="text-indent: 15px;">"State": Error</div><div style="text-indent: 15px;">"Bad argument": <b>STATE</b></div>}';
                }  
            }elseif(strtolower($_GET['name']) == "temp"){
                if(strtolower($_GET['state']) != "get"){
                    $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'temp'");
                    $req->execute(array(':state' => $_GET['state'])); 
                    echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": Temp set to '.$_GET['state'].'</div>}';  
                }else{
                    $state = $bdd->query("SELECT state FROM commandes WHERE name = 'temp'");
                    $state = $state->fetch();
                    echo $state['state'];
                }
            }elseif(strtolower($_GET['name']) == "chaudiere"){
                if(strtolower($_GET['state']) != "get"){
                    $req = $bdd->prepare("UPDATE commandes SET state = :state WHERE name = 'chaudiere'");
                    $req->execute(array(':state' => $_GET['state'])); 
                    echo '{ <br><div style="text-indent: 15px;">"State": Success</div><div style="text-indent: 15px;">"Action made": State set to '.$_GET['state'].'</div>}';  
                }else{
                    $state = $bdd->query("SELECT state FROM commandes WHERE name = 'chaudiere'");
                    $state = $state->fetch();
                    echo $state['state'];
                }
            }else{
                 echo '{ <br><div style="text-indent: 15px;">State: ERROR,</div><br><div style="text-indent: 15px;">Bad argument > <b>NAME</b></div>}';
            }
        }
    }else{
        echo '{ <br><div style="text-indent: 15px;">State: ERROR,</div><br><div style="text-indent: 15px;">Missing arguments ...</div><br>}';
    }

?>