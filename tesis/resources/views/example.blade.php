@extends('layouts.app')

@section('style')

    .borde{
    background-color: gray;
    height: 200px;
    }
    .borde1{
    background-color: aquamarine;
    {{--height: 50px;--}}
    {{--text-align: center;--}}
    }
    .borde2{
    background-color: olivedrab;
    height: 50px;
    text-align: center;
    }
    .borde3{
    background-color: orangered;
    height: 50px;
    text-align: center;
    }

@endsection

@section('content')
    @csrf
    {{--**************************************************flexbox y sistema de regillas y ocultación**************************************************--}}
    {{--<div class="container">--}}

        {{--<div class="row">--}}

            {{--<div class="col">--}}
                {{--<hr>--}}
                {{--<hr>--}}
                {{--<h3>CABECERA</h3>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore--}}
                {{--magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea--}}
                {{--commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla--}}
                {{--pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim--}}
                {{--id est laborum.</p>--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<div class="row">--}}

            {{--<div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2     d-none d-md-block  borde1"> uno </div>--}}
            {{--<div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8     borde2"> dos </div>--}}
            {{--<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2    d-none d-md-block borde3"> tres </div>--}}

        {{--</div>--}}

        {{--<div class="row">--}}

            {{--<div class="col">--}}

                {{--<h3>PIE DE PÁGINA</h3>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore--}}
                {{--magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea--}}
                {{--commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla--}}
                {{--pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim--}}
                {{--id est laborum.</p>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}

    {{--**************************************************alineación, tamaño y tipografía**************************************************--}}

    {{--<div class="container borde" style="height: 500px;">--}}
        {{--<div class="row borde1 justify-content-around" style="height: 300px;">--}}
            {{--<div class="col-3 borde2 align-self-center">--}}
                {{--<p>UNO</p>--}}
            {{--</div>--}}

            {{--<div class="col-3 borde3 align-self-start">--}}
                {{--<p>DOS</p>--}}
            {{--</div>--}}

            {{--<div class="col-3 borde2 align-self-end">--}}
                {{--<p>TRES</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Background**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12 borde2 fixed-top">--}}
                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus debitis deserunt dignissimos--}}
                {{--doloremque esse eveniet explicabo fugit in laboriosam minima, nisi, optio pariatur porro quibusdam--}}
            {{--</div>--}}

            {{--<div>--}}
                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet doloremque eius impedit minus nisi placeat quo repellendus reprehenderit velit vitae. Alias aut culpa cum cupiditate deserunt ducimus eaque facere hic id illo ipsa iste natus necessitatibus non odio officia, pariatur provident quis repellat repudiandae suscipit vel veritatis voluptas! Ad illum incidunt iure optio suscipit. Ad et eum explicabo fugiat hic, incidunt laudantium minus nam natus, perspiciatis praesentium quasi qui quibusdam quisquam soluta ut vel velit? Accusamus at dignissimos dolor dolore dolores earum ex exercitationem facere fuga fugit id ipsum quam quis sed sint tenetur veritatis, voluptates? Amet consequatur culpa earum eligendi exercitationem facere hic necessitatibus nesciunt officiis, possimus repellat voluptas voluptate? Accusamus adipisci alias, aliquid amet at consequuntur corporis cumque debitis deserunt dolor doloribus dolorum earum est et ex explicabo fugiat id illo ipsum itaque laudantium maiores maxime minus modi natus, necessitatibus nihil officiis omnis, perferendis perspiciatis praesentium quam qui quibusdam sint soluta veniam vitae. Alias aperiam aspernatur commodi doloremque laborum maxime molestias neque obcaecati quaerat ratione. Ad asperiores blanditiis corporis ducimus eum excepturi fugiat laboriosam nemo nihil obcaecati officiis pariatur provident quasi saepe sequi, suscipit unde! Ad animi consequuntur doloremque hic, ipsum iusto minus non odio pariatur quaerat. Adipisci beatae culpa debitis dignissimos eius, eos error ex, excepturi exercitationem impedit perspiciatis provident quam quibusdam, quis quisquam ratione repellendus reprehenderit vel velit vitae. Asperiores aspernatur expedita nihil quae quibusdam suscipit veritatis voluptate. Asperiores assumenda, consectetur consequatur dicta esse exercitationem, fuga fugit illum impedit incidunt nobis quasi, quisquam sapiente voluptate voluptatibus. Doloremque enim inventore nisi quis veritatis? Ipsam minus numquam recusandae veniam? Aliquam autem consequuntur eligendi esse id illum, itaque maiores minima neque nisi perspiciatis quod sit, soluta tempora tenetur ut veniam voluptates. A at atque aut consequatur cumque delectus facilis fuga illum incidunt ipsam, libero nesciunt odit officia, quidem reiciendis sequi ullam. Ad adipisci amet at atque consequatur delectus deserunt enim eveniet, harum itaque nemo neque repellat repudiandae tempora ut vel voluptates. Atque eius fugit neque sed voluptatem! Alias at atque aut earum eligendi ex id maxime, molestias nisi nulla officiis possimus sapiente sequi suscipit tempora. Ad autem culpa eos error exercitationem fuga ipsam ipsum quasi recusandae vitae? Accusantium aut autem ducimus, earum explicabo iusto odit porro quod recusandae repellat repellendus sunt vel. Ad adipisci assumenda, consequatur distinctio, earum fuga harum hic laborum magnam modi obcaecati odio odit officia officiis optio perferendis placeat quidem quos repellat sint sunt ullam voluptas. Accusamus aliquam amet at atque autem commodi consectetur consequatur consequuntur debitis, dolore dolorem dolorum earum eius enim, eos esse eveniet ex harum, id illum incidunt ipsam ipsum itaque laborum maiores molestiae necessitatibus officiis omnis perferendis quo ratione recusandae reiciendis similique sit ullam veritatis voluptas! Atque eius iure molestiae quia repellat. Adipisci autem debitis reiciendis totam ut! Accusamus accusantium alias aliquam aliquid beatae blanditiis consequuntur culpa cupiditate deleniti dignissimos dolorum eaque eligendi, esse est et explicabo facere fugit illo impedit inventore, laborum magni maiores molestiae natus nesciunt numquam odio officia possimus praesentium provident, quia recusandae sit vel? Ab illo natus rem.--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="container bg-dark">--}}
        {{--<div class="row">--}}
            {{--<div>--}}
                {{--<h1 class="display-1">HOLA A TODOS</h1>--}}
                {{--<p>Actualmente <abbr title="Lenguan de Marcas de Texto">Html</abbr> es un lenguaje muy utilizado en los--}}
                    {{--sitios web</p>--}}

                {{--<code>--}}
                    {{--body{--}}
                    {{--background-color:red;--}}
                    {{--}--}}
                {{--</code>--}}

                {{--<p>Apretar <kbd>Ctrl+C</kbd> para copiar un texto</p>--}}

                {{--<p class="font-weight-light text-center text-info"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam aperiam culpa, eaque--}}
                    {{--explicabo molestiae quo. Ad distinctio dolore, est iure magni natus nostrum optio, perferendis,--}}
                    {{--praesentium quisquam quos vel. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid excepturi magnam, optio perferendis quasi sit!--}}
                    {{--Alias amet aperiam at deserunt dicta dolor ea molestiae quam quo tempora. Accusantium, deleniti, rerum!</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Tablas**************************************************--}}

    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--<table class="table table-striped table-bordered table-hover table-dark ">--}}
                    {{--<tr>--}}
                        {{--<td class="table-secondary">Lunes</td>--}}
                        {{--<td>Martes</td>--}}
                        {{--<td class="table-secondary">Miércoles</td>--}}
                        {{--<td>Jueves</td>--}}
                        {{--<td class="table-secondary">Viernes</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td>10</td>--}}
                        {{--<td>20</td>--}}
                        {{--<td>30</td>--}}
                        {{--<td>40</td>--}}
                        {{--<td>50</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td>10</td>--}}
                        {{--<td>20</td>--}}
                        {{--<td>30</td>--}}
                        {{--<td>40</td>--}}
                        {{--<td>50</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td>10</td>--}}
                        {{--<td>20</td>--}}
                        {{--<td>30</td>--}}
                        {{--<td>40</td>--}}
                        {{--<td>50</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td>10</td>--}}
                        {{--<td>20</td>--}}
                        {{--<td>30</td>--}}
                        {{--<td>40</td>--}}
                        {{--<td>50</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Imágenes**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam cum dolorum ea et neque, quidem--}}
                    {{--quisquam. Accusantium amet animi cumque, earum ex facere non numquam odit quas reprehenderit similique velit.</p>--}}
                {{--<img src="img/ula.png" class="img-fluid w-50 img-thumbnail">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************jumbotrom y alert**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="text-justify">--}}
                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet architecto, aut, corporis cum--}}
                    {{--dolores doloribus excepturi illum ipsum laborum, molestiae officia optio quia quidem quis--}}
                    {{--repellat sed sint sunt temporibus velit? Ab adipisci aliquam asperiores assumenda at--}}
                    {{--consequuntur corporis cupiditate delectus dolor dolore ducimus enim error fuga, iure labore--}}
                    {{--laborum magnam mollitia nam, nemo nesciunt officiis provident, qui ratione rem suscipit totam--}}
                    {{--vitae voluptates. Aperiam cumque dignissimos magnam natus sit ut. Accusantium aut cumque--}}
                    {{--deserunt, ducimus earum eius, eligendi eveniet fuga fugit illum ipsa labore modi molestiae--}}
                    {{--molestias natus nemo omnis placeat quaerat quo rem repellendus soluta totam veniam? Error esse--}}
                    {{--fuga impedit in itaque, libero, magnam minima nemo pariatur, praesentium quisquam repellat--}}
                    {{--reprehenderit vero? Consequuntur delectus doloremque illum molestiae neque. Animi asperiores,--}}
                    {{--beatae blanditiis cum, cupiditate debitis dolorum ducimus eligendi facilis illum in ipsum--}}
                    {{--abore laboriosam minima nemo nisi nobis officiis pariatur perferendis quam qui quis saepe--}}
                    {{--sapiente sed tenetur ullam ut vel velit vero voluptate! A aliquid blanditiis cum esse excepturi,--}}
                    {{--harum incidunt magnam minus neque nesciunt nisi non obcaecati pariatur quis vitae. Beatae bla--}}
                    {{--nditiis, commodi delectus dicta ducimus eaque eius eligendi eos error eveniet fugiat fugit ipsa--}}
                    {{--magnam modi neque non officiis optio pariatur qui rerum saepe sapiente ut velit. A consectetur--}}
                    {{--deserunt dolore eaque ipsa itaque natus quos repudiandae. Amet aperiam dolor doloribus esse est--}}
                    {{--eveniet facilis fugiat, fugit hic ipsa iste laudantium molestiae neque nisi omnis optio praesen--}}
                    {{--tium reiciendis similique sunt velit. Consectetur debitis doloremque laboriosam non! Aliquid, am--}}
                    {{--et aperiam asperiores assumenda at beatae commodi cupiditate deleniti dignissimos earum eius eni--}}
                    {{--m, esse ex facere facilis ipsa ipsum molestiae molestias natus omnis quasi reiciendis repellend--}}
                    {{--us reprehenderit sapiente ullam voluptas voluptatum. Consectetur dignissimos id natus porro, qui--}}
                    {{--squam soluta? Aliquam at cumque fugit pariatur quam quas ut! Animi atque commodi eaque facere la--}}
                    {{--borum omnis quasi sequi voluptate.</p>--}}

                    {{--<p class="alert alert-success alert-dismissible">--}}
                    {{--<button type="button" class="close" data-dismiss="alert">&times;</button>--}}
                    {{--<strong>Felicidades</strong> la opereción conluyó satisfactoriamente.--}}
                    {{--</p>--}}


                    {{--<p class="alert-danger">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam,--}}
                    {{--exercitationem iste minima nobis numquam quam qui quos reprehenderit sapiente vel? Commodi enim--}}
                    {{--expedita hic in nostrum pariatur quidem repudiandae temporibus!--}}
                    {{--<a href="#" class="alert-link">Esto es un link</a></p>--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid at atque blanditiis--}}
                    {{--consequuntur culpa cum cumque delectus ducimus earum enim esse est eveniet facilis fugit harum--}}
                    {{--hic illum, incidunt iusto labore laborum maiores maxime neque nobis numquam pariatur perferendi--}}
                    {{--s praesentium quibusdam quisquam quod sed tempore vero voluptate. Ab aliquam cum dolorum enim,--}}
                    {{--nisi officiis? Aspernatur dolorem neque quos saepe tempore. A, ad adipisci aliquam aspernatur--}}
                    {{--commodi dicta dolor eos ex inventore ipsa minima molestias natus nisi obcaecati officiis perspi--}}
                    {{--ciatis ratione saepe, soluta tenetur voluptatum? Accusantium animi, atque blanditiis corporis c--}}
                    {{--um deleniti distinctio dolorem doloribus ducimus earum fuga inventore ipsam iure molestias nat--}}
                    {{--us nobis nostrum odio officia perspiciatis praesentium quas quis rem temporibus vitae voluptas--}}
                    {{--! Accusamus aperiam asperiores cumque debitis, ea facilis iure nobis non numquam reiciendis.--}}
                    {{--aliquam architecto consequatur eos est excepturi itaque iusto laudantium, placeat quo reiciendi--}}
                    {{--s repellat velit. Aperiam at aut commodi dolorem ducimus earum est maiores maxime modi!--}}
                    {{--aspernatur aut autem consequatur debitis, deleniti dolores exercitationem fugit harum impedit ne--}}
                    {{--mo nesciunt obcaecati omnis, quaerat quasi quibusdam ratione, repellendus sint soluta voluptat--}}
                    {{--e? Animi commodi dicta, inventore ipsam officia possimus sed voluptas? Debitis eum illo labore--}}
                    {{--minima molestiae neque, non pariatur, quae reiciendis sequi unde. Atque, error, ex. Ab consequa--}}
                    {{--tur delectus doloremque dolorum, enim harum impedit ipsa ipsam, iure laboriosam magnam minus--}}
                    {{--nostrum obcaecati omnis pariatur porro praesentium quae quidem reprehenderit rerum ut voluptate--}}
                    {{--s? Consequatur delectus ex facilis fugit incidunt iste officia perferendis quas recusandae tem--}}
                    {{--pora? Commodi deleniti dicta eligendi, et eum ex fuga hic molestiae mollitia obcaecati, offici--}}
                    {{--a omnis possimus praesentium provident quaerat sapiente similique soluta temporibus veritatis--}}
                    {{--! Autem blanditiis consequatur consequuntur corporis debitis eos nesciunt non quam quasi quos.--}}
                    {{--Ab alias amet aperiam asperiores beatae cupiditate deserunt dolor eum, iure labore laboriosam--}}
                    {{--magni minima omnis optio perspiciatis porro, praesentium quia quis quo recusandae, reprehenderi--}}
                    {{--t sit soluta totam unde veniam vitae! Adipisci assumenda esse harum id illum labore magnam maior--}}
                    {{--es modi molestiae quia? Cum cumque dolorem eaque, enim eum fugit hic id laudantium odio perferen--}}
                    {{--dis quasi ratione unde vel veritatis, vero? Ad amet culpa enim esse fugiat illo nesciunt odio--}}
                    {{--, sed sequi sint soluta? Assumenda beatae corporis delectus dolorem, eaque est expedita hic temp--}}
                    {{--oribus ut voluptas! A accusamus aliquam animi explicabo fugit maiores molestiae nobis quam quo?--}}
                    {{--Ad blanditiis dicta eius eligendi eveniet neque nostrum quae quaerat quia quo sint, voluptates.--}}
                    {{--alias cum dolore ducimus eum ex excepturi exercitationem illo, ipsa iusto modi molestias neque,--}}
                    {{--omnis perferendis quidem quo reiciendis sunt veritatis vitae voluptatem? Blanditiis dolore dolor--}}
                    {{--es est facilis ipsam laboriosam provident, quisquam ratione rem sequi similique totam voluptas--}}
                    {{--. Alias corporis fugiat nihil optio reiciendis sint temporibus vitae! Asperiores aut esse expli--}}
                    {{--cabo maxime nam, nobis odio perspiciatis saepe sapiente suscipit! Accusamus atque aut explicabo--}}
                    {{--fugiat ipsum natus optio sint veritatis voluptates voluptatibus. Alias cum ipsum odio pariatur p--}}
                    {{--rovident repellendus tempore veniam. Ad amet architecto deserunt distinctio dolores ducimus--}}
                    {{--eius, eos, explicabo itaque natus nihil perspiciatis placeat repellendus sit totam vitae? Amet--}}
                    {{--beatae illo incidunt, molestiae placeat quos.</p>--}}

                    {{--<p class="jumbotron">Acá</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************botones**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="btn-group">--}}
                    {{--<button type="button" class="btn btn-success">Enviar</button>--}}
                    {{--<button type="button" class="btn btn-danger">Cancelar</button>--}}
                    {{--<button type="button" class="btn btn-Info">Información</button>--}}
                    {{--<button type="button" class="btn btn-primary active">Activado</button>--}}
                    {{--<button type="button" class="btn btn-secondary disabled">Desactivado</button>--}}
                    {{--<button type="button" class="btn btn-outline-success">Enviar sin bordes</button>--}}
                {{--</div>--}}
                {{--<button type="button" class="btn btn-dark btn-block">Enviar</button>--}}
                {{--<div class="btn-group">--}}
                    {{--<button type="button" class="btn btn-success">Apple</button>--}}
                    {{--<button type="button" class="btn btn-success">Samsung</button>--}}
                    {{--<div class="btn-group">--}}
                        {{--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Sony</button>--}}
                        {{--<div class="dropdown-menu">--}}
                            {{--<a href="#" class="dropdown-item">Tablet</a>--}}
                            {{--<a href="#" class="dropdown-item">Smartphone</a>--}}
                            {{--<a href="#" class="dropdown-item">Computadora</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}


            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************insignia-**************************************************-}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<p>Esto es un ejemplo de <span class="badge"> insignia </span></p>--}}
                {{--<button type="button" class="btn btn-dark"> Mensajes <span class="badge badge-pill badge-light">4</span></button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Barras de progreso**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12" >--}}
                {{--<div class="progress" style="height: 50px;">--}}
                    {{--<div class="progress-bar w-75 bg-dark progress-bar-animated progress-bar-striped">75%</div>--}}
                    {{--<div class="progress-bar w-50 bg-primary progress-bar-animated progress-bar-striped">50%</div>--}}
                    {{--<div class="progress-bar w-25 bg-secondary progress-bar-animated progress-bar-striped">25%</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************paginación**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<ul class="pagination">--}}
                    {{--<li class="page-item"><a class="page-link" href="#"> < Previo </a></li>--}}
                    {{--<li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                    {{--<li class="page-item active"><a class="page-link" href="#">2</a></li>--}}
                    {{--<li class="page-item disabled"><a class="page-link" href="#">3</a></li>--}}
                    {{--<li class="page-item"><a class="page-link" href="#">Siguiente ></a></li>--}}
                {{--</ul>--}}

                {{--<ul class="breadcrumb">--}}
                    {{--<li class="breadcrumb-item"><a  href="#">Home</a></li>--}}
                    {{--<li class="breadcrumb-item"><a  href="#">Fotos</a></li>--}}
                    {{--<li class="breadcrumb-item"><a  href="#">Verano 2018</a></li>--}}
                    {{--<li class="breadcrumb-item"><a  href="#">Italia</a></li>--}}
                    {{--<li class="breadcrumb-item"><a  href="#">Roma</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<ul class="list-group">--}}
                    {{--<li class="list-group-item active">Lunes</li>--}}
                    {{--<li class="list-group-item list-group-item-success">Martes</li>--}}
                    {{--<li class="list-group-item disabled">Miércoles</li>--}}
                    {{--<li class="list-group-item list-group-item-warning">Jueves</li>--}}
                    {{--<li class="list-group-item list-group-item-danger">Viernes</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************tarjetas*************************************************--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="card w-50">--}}
                    {{--<div class="card-header">--}}
                        {{--<p>Administrador</p>--}}
                        {{--<img src="img/ula.png" class="w-50">--}}
                    {{--</div>--}}
                    {{--<div class="card-body">--}}
                        {{--<h3 class="card-title">Emmanuel Tamburini</h3>--}}
                        {{--<p class="card-text">Esta es la descripción de mi persona</p>--}}
                        {{--<a href="#" class="btn btn-primary">Ver Perfil</a>--}}
                    {{--</div>--}}
                    {{--<div class="card-footer">--}}
                        {{--<p>Esto es un pie de tarjeta</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--****************************************Menús desplegables--**************************************************}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="dropdown">--}}
                    {{--<button type="button"class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Desplgable</button>--}}
                    {{--<div class="dropdown-menu">--}}
                        {{--<div class="dropdown-header">Grupo 1</div>--}}
                        {{--<a href="#" class="dropdown-item">Link 1</a>--}}
                        {{--<a href="#" class="dropdown-item active">Link 2</a>--}}
                        {{--<a href="#" class="dropdown-item disabled">Link 3</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<div class="dropdown-header">Grupo 2</div>--}}
                        {{--<a href="#" class="dropdown-item">Link 1</a>--}}
                        {{--<a href="#" class="dropdown-item">Link 2</a>--}}
                        {{--<a href="#" class="dropdown-item">Link 3</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Botones colapsables**************************************************--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}

                {{--<button type="button" data-toggle="collapse" data-target="#uno">Primero</button>--}}
                {{--<div id="uno" class="collapse">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae dolore--}}
                    {{--eum fugit ipsum maxime, minima possimus provident reprehenderit saepe voluptatem? Atque, eum fuga--}}
                    {{--magnam perspiciatis porro provident. Ab, cupiditate, quos.--}}
                {{--</div>--}}
                {{--<button type="button" data-toggle="collapse" data-target="#dos">Segundo</button>--}}
                {{--<div id="dos" class="collapse">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae dolore--}}
                    {{--eum fugit ipsum maxime, minima possimus provident reprehenderit saepe voluptatem? Atque, eum fuga--}}
                    {{--magnam perspiciatis porro provident. Ab, cupiditate, quos.--}}
                {{--</div>--}}
                {{--<a data-toggle="collapse" href="#tres">Tercero</a>--}}
                {{--<div id="tres" class="collapse">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae dolore--}}
                    {{--eum fugit ipsum maxime, minima possimus provident reprehenderit saepe voluptatem? Atque, eum fuga--}}
                    {{--magnam perspiciatis porro provident. Ab, cupiditate, quos.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Menús en acordeón**************************************************--}}

    {{--<div id="acordion">--}}
        {{--<div class="card">--}}
            {{--<div class="card-header">--}}
                {{--<a href="#uno" class="card-link" data-toggle="collapse" data-parent="#acordion">Primero</a>--}}
            {{--</div>--}}
            {{--<div id="uno" class="collapse show">--}}
                {{--<div class="card-body">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium asperiores cumque cupiditate delectus doloremque dolores ducimus est fuga labore laborum neque optio, possimus quo quos repellendus reprehenderit sint voluptate voluptatem.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card">--}}
            {{--<div class="card-header">--}}
                {{--<a href="#dos" class="card-link" data-toggle="collapse" data-parent="#acordion">Segundo</a>--}}
            {{--</div>--}}
            {{--<div id="dos" class="collapse ">--}}
                {{--<div class="card-body">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium asperiores cumque cupiditate delectus doloremque dolores ducimus est fuga labore laborum neque optio, possimus quo quos repellendus reprehenderit sint voluptate voluptatem.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Menú de navegación**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">--}}
                    {{--<a href="#" class="navbar-brand">Inicio</a>--}}
                    {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno">--}}
                        {{--<span class="navbar-toggler-icon"></span>--}}
                    {{--</button>--}}
                    {{--<div class="collapse navbar-collapse" id="uno">--}}
                        {{--<ul class="navbar-nav justify-content-end">--}}
                            {{--<li class="nav-item"><a href="#" class="nav-link">Link1</a></li>--}}
                            {{--<li class="nav-item"><a href="#" class="nav-link">Link2</a></li>--}}
                            {{--<li class="nav-item disabled"><a href="#" class="nav-link">Link3</a></li>--}}
                            {{--<li class="nav-item dropdown ">--}}
                                {{--<a href="#" class="nav-link  dropdown-toggle" data-toggle="dropdown">Link4</a>--}}
                                {{--<div class="dropdown-menu">--}}
                                    {{--<a href="#" class="dropdown-item">Submenú1</a>--}}
                                    {{--<a href="#" class="dropdown-item">Submenú2</a>--}}
                                    {{--<a href="#" class="dropdown-item">Submenú3</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                                {{--<form action="miformulario.php" method="post" class="form-inline">--}}
                                    {{--<input type="text" placeholder="Buscar" class="form-control mr-sm-2">--}}
                                    {{--<button type="submit" class="btn btn-success">Buscar</button>--}}
                                {{--</form>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</nav>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, ratione sunt. Accusantium eaque fugit laudantium libero perferendis porro quisquam rem repudiandae! A animi asperiores aut consectetur dolore dolorem excepturi expedita fugit, in iste iure labore minus mollitia omnis optio possimus, quasi quia quisquam ratione reiciendis reprehenderit repudiandae tenetur totam velit vitae? Blanditiis deserunt magnam perferendis placeat quae! Accusamus eos est ipsum laboriosam nobis porro reiciendis veniam. Cumque dolorem expedita laboriosam maxime odio porro, tenetur. Autem commodi consectetur, dicta distinctio dolores eveniet facere illum, iusto magni minus perspiciatis reiciendis sunt veniam! Commodi, dolorum exercitationem explicabo labore laboriosam pariatur perferendis quo. Est eum ipsum iste, molestias pariatur rem voluptatum! A, accusantium amet architecto culpa cum deleniti deserunt doloremque doloribus et excepturi fuga fugit maxime minima neque quaerat quis sed. Aliquam architecto beatae commodi consequatur corporis delectus dignissimos dolore ea eaque error est et ex facere hic illum impedit iusto laboriosam, laudantium maiores molestiae mollitia neque obcaecati porro quidem ratione reiciendis rem sapiente sed sint suscipit tempora tempore ullam ut vel veritatis vero vitae. Alias asperiores dolor enim eos exercitationem ipsum itaque quis voluptatem. Adipisci consequatur delectus ea eaque eius esse inventore minima quo quos ut? Dolore facilis hic iure nemo neque obcaecati quod repellat. Accusantium amet aut dicta id iste perferendis rerum sit ullam veritatis vero! Alias consequuntur dolor eveniet ex explicabo fuga hic molestias mollitia necessitatibus non quas, quis reiciendis reprehenderit veniam, vitae. Aliquid blanditiis consectetur, corporis ex nam pariatur placeat repudiandae sint temporibus? Aut doloremque earum exercitationem impedit maiores numquam odio, placeat vel veritatis voluptate. Atque dolores harum iusto neque quo vitae! Dicta dolor ipsa laudantium nam neque officiis, perspiciatis quia ut. Deleniti distinctio esse natus officia recusandae. A animi aperiam autem beatae blanditiis commodi dolore dolorem esse, eveniet exercitationem expedita fuga ipsa ipsam iusto laboriosam minus molestiae molestias nemo nostrum officia omnis pariatur porro possimus praesentium quam rerum tempore temporibus ullam ut vitae! Accusantium adipisci autem beatae cum deserunt dolorum explicabo, ipsum labore laborum, minus nemo nesciunt nulla, sit! Ad adipisci beatae, delectus eius harum in molestias nam nobis nulla odio odit possimus quisquam, quos repellendus tenetur velit voluptatem! A cum ducimus eligendi esse fuga id illo iure iusto modi, obcaecati pariatur perspiciatis quam quidem, quo quod reprehenderit, soluta vitae voluptatum. A ab accusamus amet aperiam at consequuntur culpa cupiditate deleniti dolorem dolorum earum, eligendi ex excepturi, harum iste, labore laudantium nihil numquam pariatur quae quidem quo recusandae sapiente sint vero vitae voluptates voluptatum! Ad aliquid, aperiam aspernatur culpa, deleniti dolore doloribus ducimus eos esse est exercitationem fuga hic illo itaque iure laborum modi neque nesciunt obcaecati odio officiis, optio placeat quaerat qui quisquam ratione sunt tenetur ullam vero voluptate! Atque consequuntur cum enim, eum ex minima nulla odit porro, praesentium quas quidem repellendus reprehenderit repudiandae, rerum tempora! Alias aliquid animi aspernatur corporis distinctio eligendi enim exercitationem facere illum impedit, inventore natus necessitatibus nihil nobis provident quae qui quisquam recusandae rem, repellat similique tenetur totam velit vero, voluptatibus. Ad, consequatur culpa delectus distinctio earum, fuga harum, hic in laboriosam maxime necessitatibus nemo nesciunt nulla placeat provident quos ratione repudiandae sed soluta totam unde veritatis vero! Animi commodi consectetur dolorem est et explicabo, facilis iure, mollitia nostrum, perferendis provident sequi tenetur velit vitae voluptatum! Asperiores cum dolor obcaecati officiis reprehenderit saepe sit ullam voluptate! Dicta earum magnam necessitatibus neque porro qui sequi? Accusamus architecto aspernatur commodi consequuntur, delectus deserunt distinctio dolore dolorum et explicabo facere fuga hic iusto maiores minus mollitia obcaecati omnis possimus quaerat quibusdam quos reprehenderit sint? A aliquam aliquid amet, at consectetur culpa cum delectus earum expedita, impedit in nihil perspiciatis praesentium quo repellat soluta vel veritatis voluptas. Amet aut cumque cupiditate eaque exercitationem expedita fugit hic id, illo ipsam, laborum magnam maxime molestias necessitatibus, neque nisi non nostrum provident quam quia quisquam quod quos repellendus similique vero voluptatem voluptatum! Ab alias assumenda beatae consectetur culpa cumque doloremque doloribus eaque error esse, excepturi fuga labore obcaecati officiis temporibus unde vel! Accusamus autem culpa fugiat harum illum nisi nulla praesentium quibusdam veniam! Architecto aut enim qui tempora. Non possimus, quas? Autem cupiditate debitis dolorem doloremque error nisi omnis qui repellendus! Adipisci aliquam aspernatur assumenda cum distinctio dolor esse est impedit, libero quasi ratione rem saepe sint tempore, velit! A at consequuntur dolorum eveniet harum ipsum itaque labore laboriosam laudantium minus modi mollitia numquam obcaecati omnis, optio perferendis quibusdam quo saepe tempore totam ut voluptatem, voluptatum! Accusamus architecto aspernatur at atque blanditiis, consequatur corporis deleniti dignissimos dolor doloribus ea enim est exercitationem expedita facilis fugiat illo ipsa ipsum itaque labore magni minus modi nemo nisi nobis nostrum placeat possimus, praesentium, quaerat quia ratione recusandae reiciendis rem repellat reprehenderit ut veniam? Magni, nobis, non. Iure nobis, odio! Animi autem cum enim labore vero. Ab adipisci aliquam architecto aspernatur at commodi corporis cumque cupiditate dolore eligendi, error est et eveniet ex explicabo hic itaque iusto libero magnam maiores minima officia qui quis quisquam ratione recusandae reiciendis repellat reprehenderit sed sequi sit sunt tempore temporibus unde, veritatis vero voluptatibus! Autem harum possimus quasi quibusdam similique! Consectetur cumque earum eum facilis odit reiciendis vitae voluptatibus? Aspernatur fugit illo neque quaerat quo veniam voluptatibus. Accusamus at commodi culpa dignissimos dolore earum eveniet ex exercitationem ipsam laudantium mollitia, nisi officia provident quibusdam, soluta totam voluptatem. Aut dicta distinctio ducimus enim fugiat in iusto laborum libero minus molestiae, nobis perspiciatis quasi. Accusantium aspernatur aut blanditiis consectetur corporis deleniti dicta distinctio dolorem ducimus eaque eligendi esse exercitationem expedita explicabo fugiat fugit ipsa iure, libero neque nesciunt nostrum, nulla officia perferendis porro quam quod rem repudiandae sed similique tempora tempore temporibus velit veniam voluptas voluptate, voluptates voluptatum? Accusamus beatae, consequuntur culpa, cupiditate deleniti enim est eum exercitationem, incidunt placeat repellendus reprehenderit totam? At autem commodi corporis deserunt eum ipsa, laudantium, libero nemo optio porro quos temporibus. Accusamus dolorem id officia quas vero. A accusamus adipisci alias animi assumenda atque beatae consectetur culpa debitis deleniti distinctio eaque eius eos facere fugiat id illum incidunt ipsum magni minus modi natus nemo nobis odio perferendis placeat quae quas quia quisquam quod, ratione reprehenderit sed soluta tempora unde vel voluptatibus! Beatae esse et nisi numquam odit? Autem, debitis dolorum ducimus expedita illum iure, magnam modi nam nemo odio quaerat quis quo sunt tempora velit? Esse iusto, magni? A accusantium ad aperiam architecto assumenda atque blanditiis debitis delectus deserunt dignissimos dolore doloremque eius enim esse fugiat iure laboriosam laudantium modi necessitatibus neque, perspiciatis quas qui quisquam reprehenderit sequi similique sint sunt temporibus ullam voluptatibus! Eaque eos hic illo placeat quae quod voluptas voluptate. Architecto cum id impedit incidunt ipsum nam nesciunt rem veniam. Aliquid, beatae consectetur culpa dolor dolore ea eaque eligendi error id incidunt ipsum laboriosam magni molestias nisi nostrum nulla obcaecati optio pariatur perferendis quas recusandae sapiente tempore voluptas! Amet blanditiis commodi consectetur consequatur cumque dignissimos dolorum ducimus enim esse excepturi, exercitationem expedita explicabo fuga fugiat impedit iste minima molestiae molestias nemo omnis, quae quam qui reiciendis rerum sed temporibus vero! A aliquid at blanditiis cum debitis et eum exercitationem fuga id illo, impedit in iure laboriosam, mollitia natus nesciunt nihil odio, officia pariatur ratione recusandae tenetur ullam voluptatibus. Accusamus asperiores at, beatae consequuntur culpa dicta dolor dolorem enim eos est fugit impedit iure libero modi molestiae nemo non odit perspiciatis quis quisquam quo sed tempora tenetur ut vel velit vitae? Autem consequuntur cumque dicta dolor, exercitationem nesciunt praesentium tempore. Autem blanditiis consequatur dolores facere, facilis incidunt magni mollitia non officiis perferendis provident sit tempora tempore? Aperiam atque, culpa cupiditate dolore ducimus exercitationem facere fuga harum in laudantium nisi obcaecati omnis perferendis perspiciatis provident quaerat quidem quis repellat reprehenderit sit suscipit, tenetur veritatis voluptate! Ab at atque commodi delectus dignissimos, ducimus earum enim esse facere fugiat harum illo in laboriosam minima neque nesciunt nisi obcaecati quasi quos reprehenderit rerum saepe sit soluta temporibus voluptas. Aliquam architecto autem culpa debitis dolores doloribus, est ex fugit impedit ipsam ipsum laudantium maxime nam natus nemo nesciunt nihil non obcaecati quaerat quo quod recusandae rem repellat repellendus repudiandae sapiente sed similique. Aperiam laborum magnam unde! Dolorem eaque esse impedit quia quibusdam quod velit. Ad aliquam consequatur deleniti deserunt distinctio dolor dolore dolorem eos id illo inventore itaque iure laudantium molestiae natus nulla obcaecati omnis porro possimus quae, quam, quasi recusandae sapiente sequi ullam ut vel voluptates? Accusamus, aliquam consequuntur corporis cupiditate dicta dolorum, earum excepturi facilis iusto maxime minus molestias nisi nobis omnis porro provident quaerat sit tempora, totam unde vel voluptate voluptatem voluptatum. Ab debitis, dolore? Ab aliquam consequuntur dolorem ea earum fuga fugit illum inventore laborum laudantium molestiae, mollitia nobis odio quaerat quam reiciendis repellat rerum sunt ut velit. Ducimus eum iure nobis odio optio perspiciatis possimus quo sit ullam? Ab corporis eos eum exercitationem impedit inventore mollitia, reprehenderit. Eaque eum id iusto odio perferendis sit tempora. Architecto aut consequatur doloribus, ex facere id illo iusto magnam minima minus, omnis perferendis quasi repellat veritatis vitae voluptatem voluptatum? Adipisci aliquam assumenda aut, cupiditate deleniti dicta dolores, excepturi incidunt inventore nisi officiis provident quae repellat, saepe sint soluta voluptatum! Aspernatur earum magnam minus molestiae odio?</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************formularios**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--<h1>Formulario de contacto</h1>--}}
                {{--<form action="proceso.php" method="post">--}}
                    {{--<label for="nombre">Nombre</label> <input type="text" id="Nombre" class="form-control">--}}
                    {{--<label for="email">Email</label> <input type="email" id="email" class="form-control">--}}
                    {{--<label for="tiempo">Fecha</label> <input type="datetime" id="tiempo" class="form-control">--}}
                    {{--<label for="color">Color</label> <input type="color" id="color" class="form-control">--}}
                    {{--<label for="contrasena">Contraseña</label> <input type="password" id="contrasena" class="form-control">--}}
                    {{--<label for="recordar" class="form-check-label"><input type="checkbox" class="form-check-input">Recordarme</label> <br>--}}
                    {{--<textarea name="descripcion" id="uno" cols="60" rows="10"></textarea> <br>--}}
                    {{--<div class="form-check">--}}
                        {{--<label for="dos" class="form-check-label">--}}
                            {{--<input type="checkbox" class="form-check-input" value=""> opción1--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        {{--<label for="dos" class="form-check-label">--}}
                            {{--<input type="checkbox" class="form-check-input" value=""> opción2--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        {{--<label for="dos" class="form-check-label">--}}
                            {{--<input type="checkbox" class="form-check-input" value=""> opción3--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio"><label class="radio-inline"><input type="radio" name="gusto">Televisión</label></div>--}}
                    {{--<div class="radio"><label class="radio-inline"><input type="radio" name="gusto"> Radio</label></div>--}}
                    {{--<div class="radio"><label class="radio-inline"><input type="radio" name="gusto"> Internet</label></div>--}}
                    {{--<select name="dias">--}}
                        {{--<option value="Lunes">Lunes</option>--}}
                        {{--<option value="Martes">Martes</option>--}}
                        {{--<option value="Miercoles">Miércoles</option>--}}
                    {{--</select>--}}
                    {{--<br>--}}
                    {{--<input type="submit" value="ENVIAR" class="btn btn-primary">--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************carrucel**************************************************--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--<div id="demo" class="carousel slide" data-ride="carousel">--}}

                    {{--Indicadores--}}

                    {{--<ul class="carousel-indicators">--}}
                        {{--<li data-target="demo" data-slide-to="0" class="active"></li>--}}
                        {{--<li data-target="demo" data-slide-to="1" ></li>--}}
                        {{--<li data-target="demo" data-slide-to="2" ></li>--}}
                    {{--</ul>--}}

                    {{--Imagenes--}}

                    {{--<div class="carousel-inner">--}}
                        {{--<div class="carousel-item active">--}}
                            {{--<img src="img/ula.png" class="img-fluid">--}}
                            {{--<div class="carousl-caption">--}}
                                {{--<h3>Primer título</h3>--}}
                                {{--<p>Esta es la descipción de la imagen</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="carousel-item">--}}
                            {{--<img src="img/ula.png" class="img-fluid">--}}
                            {{--<div class="carousl-caption">--}}
                                {{--<h3>Segundo título</h3>--}}
                                {{--<p>Esta es la descipción de la imagen</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="carousel-item">--}}
                            {{--<img src="img/ula.png" class="img-fluid">--}}
                            {{--<div class="carousl-caption">--}}
                                {{--<h3>Tercer título</h3>--}}
                                {{--<p>Esta es la descipción de la imagen</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--controles de la izquierda y derecha--}}
                    {{--<a href="#demo" class="carousel-control-prev" data-slide="prev"> <span class="carousel-control-prev-icon"></span></a>--}}
                    {{--<a href="#demo" class="carousel-control-next" data-slide="next"> <span class="carousel-control-next-icon"></span></a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--**************************************************Modal (avisos emergentes)--**************************************************}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--Botón modal--}}
                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mimodal">Consulta</button>--}}

                {{--El modal--}}
                {{--<div class="modal fade" id="mimodal">--}}
                    {{--<div class="modal-dialog">--}}
                        {{--<div class="modal-content">--}}

                            {{--Header--}}

                            {{--<div class="modal-header">--}}
                                {{--<h4 class="modal-title">Cabecera</h4>--}}
                                {{--<button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>--}}
                            {{--</div>--}}

                            {{--Body--}}
                            {{--<div class="modal-body">--}}
                                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae culpa debitis dignissimos dolorem, eaque expedita explicabo in ipsa iusto laudantium magni maiores odit, pariatur porro, provident repellendus sit tempore voluptates!--}}
                            {{--</div>--}}
                            {{--Footer--}}
                            {{--<div class="modal-footer">--}}
                                {{--<button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--*************************tooltip (información de enlaces--*************************}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--<a href="#" data-toggle="tooltip" title="Este es el tooltip">Pon el ratón para ver</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

