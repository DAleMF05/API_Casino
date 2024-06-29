# https://markdown.es/sintaxis-markdown/
## Índice
1. [clienteApiController](#documentación-clienteapicontroller)
    - [Función `showAllClients()`](#función-showallclients)
    - [Función `getClient()`](#función-getclient)
2. [AuthApiController ](#documentación-authapicontroller)
    - [Función `getAllUsers()`](#función-getallusers)
    - [Función `getUser()`](#función-getuser)
3. [Requisitos y notas adicionales](#requisitos-y-notas-adicionales)

___

# Documentación `clienteApiController`
## Introducción
El clienteApiController es una clase encargada de manejar las solicitudes relacionadas con los clientes dentro de nuestra aplicación. Actúa como un intermediario entre el cliente y el modelo de datos, proporcionando una interfaz para interactuar con los clientes a través de varias operaciones CRUD (Crear, Leer, Actualizar, Eliminar). El objetivo principal del clienteApiController es facilitar una gestión eficiente y organizada de los clientes, garantizando que todas las operaciones se realicen de manera coherente y segura.
A continuación se detallan cada una de sus funciones.


 

## Función `showAllClients()`

### Descripción
La función `showAllClients` del controlador obtiene todas los clientes de la base de datos y envía una respuesta adecuada al cliente basado en el resultado.


![Imágen del código de la función showAllClients](img/img-clientes/showAllClients.PNG)


### Retorno
La función no retorna ningún valor directamente. En su lugar, envía una respuesta al cliente utilizando el objeto `view`. Los posibles códigos de estado de respuesta son:

- **200 OK:** Si se obtuvieron clientes correctamente.
- **404 Not Found:** Si no hay clientes en la base de datos.
- **500 Internal Server Error:** Si ocurre un error del servidor al intentar obtener los clientes.

## Ejemplos de uso 
## URL: `API_Casino/api/clientes`
## METODO : GET
## Query Params `?atributo=nombre_usuario&order=asc`

### Ejemplo 1: Obtención exitosa de clientes

Si hay clientes en la base de datos, la función enviará una respuesta con código 200 y los clientes en formato JSON:
```json
{
    "status": 200,
    "clientes": [
        {
            "id_cliente": 1,
            "nombre_usuario": "Juan",
            "saldo_cliente": 3500,
            "activado_cliente": 1,
            "id_agente": 2
        }
        ...
    ]
}
```

### Ejemplo 2: Clientes no encontradas

Si no existen clientes en la base de datos, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "No hay clientes en la base de datos"
   }
}
```
### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```








## Función `getClient()`

### Descripción
La función `getClient` obtiene el cliente que se desee siempre y cuando coincida el id del mismo, con el que se introduce a la hora de realizar la busqueda. Si el Id no existe, envia un mensaje en el que dice que no existe el cliente en la base de datos.

![Imágen del código de la función getClient](img/img-clientes/getClient.png.png)


### Retorno
La función no retorna ningún valor directamente. 

- **201 CREATED:** Si se creo el cliente correctamente
- **404 Not Found:** Si no es posible crear el cliente, o el id del agente ingresado no existe.

## Ejemplos de uso 
## URL: `API_Casino/api/clientes`
## METODO : POST

### Ejemplo 1: 

Elegimos el método POST y ponemos los siguientes datos en body, el id_cliente en 0 para que cuando lo cree, ponga el id que corresponde siguiendo el orden ascende que tiene por defecto.
```json
   {
        "id_cliente": 0,
        "nombre_usuario": "Prueba",
        "saldo_cliente": 3500,
        "activado_cliente": 1,
        "id_agente": 2
   }
```


### Ejemplo 2: Cliente no encontrado (falta terminar)

Si no existe el cliente que se busco en la base de datos, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "No existe ese cliente en la base de datos"
   }
}
```
### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```



## Función `newClient()`

### Descripción
La función `newClient` lo que hace es crear un nuevo cliente, y en base a si se crea o no envia una respuesta de parte del servidor.

![Imágen del código de la función newClient](img/img-clientes/newClient.PNG)


### Retorno
La función no retorna ningún valor directamente. 

- **201 CREATED:** Si se creo el cliente correctamente
- **404 Not Found:** Si no es posible crear el cliente, o el id del agente ingresado no existe.

## Ejemplos de uso 
## URL: `API_Casino/api/clientes`
## METODO : POST

### Ejemplo 1: Creación exitosa del Cliente

Elegimos el método POST y ponemos los siguientes datos en body.Los datos ingresados son en forma de ejemplo.

```json
          {
            "nombre_usuario": "ALBERTO",
            "saldo_cliente": 2000,
            "activado_cliente": 1,
            "id_agente": 2
        }
```


### Ejemplo 2: Cliente no creado o Agente inexistente

Si el ID de agente que se ingresa no existe y si al crear el cliente ponemos algun dato mal del post, va a aparecer el siguiente mensaje.
```json
{
   {
    "status": 404,
    "message": "Eror al insertar"o"No existe agente con ese ID"
   }
}
```

### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```

## Función `deleteClient()`

### Descripción
En esta funcion podes eliminar un cliente de la base de datos ingresando su ID, Si el ID que se ingresa no existe, va a aparecer un mensaje de error, sino va a eliminar el cliente.


![Imágen del código de la función newClient](img/img-clientes/)

### Retorno
La función no retorna ningún valor directamente.

- **200 OK:** Si se eliminó un cliente correctamente.
- **404 Not Found:** Si no existe el cliente en la base de datos.
- **500 Internal Server Error:** Si ocurre un error del servidor al intentar obtener el cliente.

## Ejemplos de uso `http://localhost/proyectos/API_Casino/api/clientes/1`
### Ejemplo 1: Obtención exitosa de el cliente

Si el cliente con el ID proporcionado existe, la función enviará una respuesta con código 200 y el id del cliente eliminado en formato JSON:
```json
{
    "status": 200,
    "message": [{
        "id_cliente": 2,
        "nombre_usuario": "Anibal",
        "saldo_cliente": 15000,
        "activado_cliente": 1,
        "id_agente": 2
    }]
}
```

### Ejemplo 2: cliente no encontrado

Si no existe un cliente con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "No existe el cliente con id: 2"
   }
}
```

### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```










### Ejemplo 2: cliente no encontrado

Si no existe un cliente con el ID proporcionado, la función enviará una respuesta con código 404 y un mensaje de error:
```json
{
   {
    "status": 404,
    "message": "No existe el cliente con id: 2"
   }
}
```

### Ejemplo 3: Error de servidor

Si ocurre un error del servidor, la función enviará una respuesta con código 500 y un mensaje de error:

```json
{
    "status": 500,
    "message": "Error de servidor: [detalles del error]"
}
```

### Notas 

<!-- - **La inclusión del mensaje de excepción (`$e->getMessage()`) en la respuesta de error del servidor puede ser útil   para depuración, pero puede exponer detalles sensibles del servidor. Considera esta práctica con cuidado, especialmente en entornos de producción.** 
- **Asegúrate de manejar adecuadamente las excepciones y errores en el modelo y la vista para evitar problemas inesperados.**  -->


### Notas 


___

# Documentación `UserApiController`
## Introducción
............................................
..............................................
.................................................

## Función `getAllUsers()`

### Descripción
............................................
..............................................
.................................................


## Función `getUser()`

### Descripción
............................................
..............................................
.................................................




___


## Requisitos y notas adicionales
- Modelo de tarea debe implementar los siguientes métodos `getTasks`, `getTask`.
- Modelo de usuario debe implementar los siguientes métodos `getAllUsers`, `getUser`.
- Vista que implemente el método `response`.
