Plataforma para la gestión de documentos en la Escuela de Ingeniería de Sistemas de la ULA

-Se deberá instalar el proyecto en el entorno deseado como cualquier aplicación de laravel 5.6, de no conocer como hacerlo se recomienda seguir el tutorial de la siguiente página https://styde.net/como-instalar-proyectos-existentes-de-laravel/ (Jeff ,2015, revisado el día 15 de Marzo del 2019).

-Adicional a lo anterior será necesario para la instalación de este proyecto configurar en la archivo "constants.php" ubicado en la carpeta config, ya que el mismo posee muchas direcciones y valores que se utilizan en el correcto funcionamiento de la aplicación y que pueden variar dependiendo del entorno donde se deseé instalar dicha aplicación.

-También se deberá configurar el archivo "env." que se encuentra en la raiz del proyecto y que además de las modificaciones que conlleva realizar el primer paso, se deberá configurar las variables de entorno para el uso del correo electrónico , de no saber como hacerlo el siguiente tutorial de la página https://styde.net/envio-de-emails-con-postmark-en-laravel/ (Jeff ,2015, revisado el día 15 de Marzo del 2019), podría ser de utilidad.

-Si se desean correr los test correspondientes de phpUnit (acción que se recomienda hacer por la metodología usada para la creación de este proyecto) se recomienda hacer la configuración de las variabes de entorno en el archivo "phpunit.xml" ubicado en la raíz del proyecto, las mismas se deberán configurar de manera análoga a las variables den entorno comunes pero estás solo funcionarán en test.

-Por último si se desean correr los teste correspondiente de LaravelDusk se deberá configurar el archivo ".env.dus.local" el cual poseé las variables de entorno que se ejecutan al momento de correr los test de laravelDusk 
