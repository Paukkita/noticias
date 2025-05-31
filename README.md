# 📰  Proyecto Noticias - Ver noticias
## Estado: 🚧 En Desarrollo (La barra superior se mantendrá mientras esté en desarrollo para facilitar testing)

## Enlace al Proyecto

Puedes acceder al proyecto en línea en el siguiente enlace:

[Noticias Pau - Proyecto en Producción](https://noticias-production-d414.up.railway.app)

## Credenciales de Acceso

### Cuenta de Administrador:

- **Email:** [Pau@gmail.com](mailto:Pau@gmail.com)
- **Contraseña:** `1234`

## Cuenta de Usuario Común:
- **Email:** [paulo@gmail.com](mailto:paulo@gmail.com)
- **Contraseña:** `1234`
  
## Descripción
Este proyecto es una plataforma de noticias donde los periodistas pueden crear, editar y eliminar publicaciones, gestionar géneros y ver qué lectores han dado "me gusta". Los lectores pueden registrarse, explorar noticias, dar "me gusta" y filtrar contenido por género, además de gestionar su perfil personal.

Actualmente en desarrollo, falta mejorar la estética y corregir algunos errores del programa.

## 🌟 Características  
- 📰 **Gestión de noticias**: Los periodistas pueden crear, editar y eliminar publicaciones fácilmente.
- 👍 **Me gusta en noticias**: Los lectores pueden dar "me gusta" a las noticias que más les interesen.
- 📂 **Filtrado de noticias**: Los lectores pueden filtrar las noticias por género de su interés.
- 📅 **Listado de noticias**: Los lectores pueden ver todas las noticias publicadas por los periodistas.
- 📝 **CRUD de lectores**: Los administradores pueden gestionar los lectores registrados, viendo su información y realizando modificaciones.

## 🛠️ Tecnologías utilizadas

- **PHP** (Laravel).

## Instalación
1. Clona el repositorio:
   ```sh
   git clone https://github.com/usuario/repositorio.git
   ```
2. Accede al directorio del proyecto:
   ```sh
   cd nombre-del-proyecto
   ```
3. Instala las dependencias:
   ```sh
   npm install
   ```
4. Inicia el servidor de desarrollo:
   ```sh
   npm run dev
   ```

## Diseño de la pagina y funcionamiento básico
## 🔑 Vista de Registro de Usuario
La vista de registro permite a los nuevos usuarios crear una cuenta. Deben completar un formulario con sus datos básicos para poder registrarse.

![image](https://github.com/user-attachments/assets/662d3914-9a0a-495c-9801-ea124807e86b)

## 🔐 Vista de Login de Usuario
Los usuarios existentes pueden iniciar sesión proporcionando su nombre de usuario y contraseña. Esta vista garantiza un acceso seguro a la plataforma.

![image](https://github.com/user-attachments/assets/434a5668-9d63-4c98-a22f-d2de3777a043)


## ⚠️ Vista de Errores de Validación(Esto se mantenendrá igual en toda la página web)
Si los datos proporcionados durante el registro o el login no son correctos, se muestran los errores correspondientes para corregir la información. 

![image](https://github.com/user-attachments/assets/752834b1-bd95-42ae-ac61-f907ae47c51e)


## 📝 Vista de Noticias como Admin
Los administradores (periodistas) tienen un acceso completo para gestionar las noticias. Pueden ver todas las publicaciones creadas y realizar acciones como crear, editar o eliminar noticias.

![image](https://github.com/user-attachments/assets/380db7c8-98a4-494f-abe8-72bde32b4bdb)


![image](https://github.com/user-attachments/assets/c7bd9c27-f3e8-42c1-a3a7-fbfcb14d4720)


## 📝 Vista de Noticias como Usuario
Los usuarios tienen un acceso reducido para observar las noticais. Pueden ver todas las publicaciones creadas y dar me gusta o quitarlos.

![image](https://github.com/user-attachments/assets/33fb7324-3adf-4759-bca4-051b02d51c90)


## 👍 Vista de Usuario con "Me Gusta"
Los usuarios pueden interactuar con las noticias dando "me gusta" a sus publicaciones favoritas. Esta vista muestra las noticias que un usuario ha marcado como favoritas.

![image](https://github.com/user-attachments/assets/7b65c1cc-5ff2-47c6-b521-036785670273)


## 📰 Vista de Noticia Individual
Cada noticia tiene su propia página detallada donde se puede leer la publicación completa y ver la información adicional de la misma.

![image](https://github.com/user-attachments/assets/afcf2fc1-d5d3-4056-a801-d146cfd6acf2)


## ✏️ Vista de Edición de una Noticia, borrado y regreso al inicio (Admin)
El administrador puede editar cualquier noticia publicada. Esta vista permite modificar el contenido, título, género, etc., de una noticia existente.

![image](https://github.com/user-attachments/assets/53908b3f-9fa2-4000-9ad0-46adb346a4a9)


## 👥 Vista de Todos los Usuarios
Como administrador, se puede acceder a una lista completa de los usuarios registrados. Esta vista muestra los detalles básicos de cada usuario.

![image](https://github.com/user-attachments/assets/c95e8db7-a7d6-4f1d-8ff3-24731b1872e2)


## ✏️ Vista de Edición de Usuario
El administrador tiene la capacidad de editar la información de los usuarios registrados, como sus datos personales y de contacto.

![image](https://github.com/user-attachments/assets/f009ed71-750e-43db-872a-a0cf30c91269)


## 👤 Vista de Perfil de Usuario
Los usuarios registrados pueden ver y editar su propio perfil. Esta vista permite modificar sus datos personales y gestionar sus preferencias.

![image](https://github.com/user-attachments/assets/d030d4c6-f419-4621-808e-fe6eb99ba53b)



## Contribución
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature-nueva`).
3. Realiza los cambios y haz commit (`git commit -m 'Agrega nueva funcionalidad'`).
4. Sube los cambios (`git push origin feature-nueva`).
5. Abre un Pull Request.


## 👥 Colaboradores
- Creador: Pau Barón [@Paukkita]
- Participantes: Aún no hay colaboradores. ¡Anímate a contribuir! 🚀
