Plataforma para la gesti�n de documentos en la Escuela de Ingenier�a de Sistemas de la ULA

-Se deber� instalar el proyecto en el entorno deseado como cualquier aplicaci�n de laravel 5.6, de no conocer como hacerlo se recomienda seguir el tutorial de la siguiente p�gina https://styde.net/como-instalar-proyectos-existentes-de-laravel/ (Jeff ,2015, revisado el d�a 15 de Marzo del 2019).

-Adicional a lo anterior ser� necesario para la instalaci�n de este proyecto configurar en la archivo "constants.php" ubicado en la carpeta config, ya que el mismo posee muchas direcciones y valores que se utilizan en el correcto funcionamiento de la aplicaci�n y que pueden variar dependiendo del entorno donde se dese� instalar dicha aplicaci�n.

-Tambi�n se deber� configurar el archivo "env." que se encuentra en la raiz del proyecto y que adem�s de las modificaciones que conlleva realizar el primer paso, se deber� configurar las variables de entorno para el uso del correo electr�nico , de no saber como hacerlo el siguiente tutorial de la p�gina https://styde.net/envio-de-emails-con-postmark-en-laravel/ (Jeff ,2015, revisado el d�a 15 de Marzo del 2019), podr�a ser de utilidad.

-Si se desean correr los test correspondientes de phpUnit (acci�n que se recomienda hacer por la metodolog�a usada para la creaci�n de este proyecto) se recomienda hacer la configuraci�n de las variabes de entorno en el archivo "phpunit.xml" ubicado en la ra�z del proyecto, las mismas se deber�n configurar de manera an�loga a las variables den entorno comunes pero est�s solo funcionar�n en test.

-Por �ltimo si se desean correr los teste correspondiente de LaravelDusk se deber� configurar el archivo ".env.dus.local" el cual pose� las variables de entorno que se ejecutan al momento de correr los test de laravelDusk 
