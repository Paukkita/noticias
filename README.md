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

![Vista de registro de usuario](![image](https://github.com/user-attachments/assets/126f1f5e-4049-495d-9850-17e85041ea52)


## 🔐 Vista de Login de Usuario
Los usuarios existentes pueden iniciar sesión proporcionando su nombre de usuario y contraseña. Esta vista garantiza un acceso seguro a la plataforma.

![Vista de login de usuario](![image](https://github.com/user-attachments/assets/3570556f-03f5-45d7-980d-4e1a624a1e6d)


## ⚠️ Vista de Errores de Validación
Si los datos proporcionados durante el registro o el login no son correctos, se muestran los errores correspondientes para corregir la información.

![Vista de errores de validación](![image](https://github.com/user-attachments/assets/51bf80a7-d0c6-416a-b660-5a8ee7b594de)


## 📝 Vista de Noticias como Admin
Los administradores (periodistas) tienen un acceso completo para gestionar las noticias. Pueden ver todas las publicaciones creadas y realizar acciones como crear, editar o eliminar noticias.

![Vista de noticias como admin](![image](https://github.com/user-attachments/assets/bb38dcd9-ea00-468b-8ac7-f27b53a14f52)

![image](https://github.com/user-attachments/assets/c7bd9c27-f3e8-42c1-a3a7-fbfcb14d4720)


## 📝 Vista de Noticias como Usuario
Los usuarios tienen un acceso reducido para observar las noticais. Pueden ver todas las publicaciones creadas y dar me gusta o quitarlos.

![Vista de noticia como usuario](![image](https://github.com/user-attachments/assets/4c48d353-38cb-4f6b-a1b5-fd2f51cabd18)
)


## 👍 Vista de Usuario con "Me Gusta"
Los usuarios pueden interactuar con las noticias dando "me gusta" a sus publicaciones favoritas. Esta vista muestra las noticias que un usuario ha marcado como favoritas.

![Vista de usuario con me gusta](![image](https://github.com/user-attachments/assets/0059740d-4241-41de-b00d-e55152286e01)
)

## 📰 Vista de Noticia Individual
Cada noticia tiene su propia página detallada donde se puede leer la publicación completa y ver la información adicional de la misma.

![Vista de noticia individual](![image](https://github.com/user-attachments/assets/451a3d69-aa23-4cd3-9998-3a003e3a504b)
)

## ✏️ Vista de Edición de una Noticia, borrado y regreso al inicio (Admin)
El administrador puede editar cualquier noticia publicada. Esta vista permite modificar el contenido, título, género, etc., de una noticia existente.

![Vista de edición de una noticia](![image](https://github.com/user-attachments/assets/91f63bda-150e-40be-9ec3-2fd8a85ec3d9)
)

## 👥 Vista de Todos los Usuarios
Como administrador, se puede acceder a una lista completa de los usuarios registrados. Esta vista muestra los detalles básicos de cada usuario.

![Vista de todos los usuarios](![image](https://github.com/user-attachments/assets/87a4b667-f75a-45a4-a2d1-689aa78fb42b)
)

## ✏️ Vista de Edición de Usuario
El administrador tiene la capacidad de editar la información de los usuarios registrados, como sus datos personales y de contacto.

![Vista de edición de usuario](![image](https://github.com/user-attachments/assets/c7aff6ea-b41c-43ab-a56d-cc43433897fc)
)

## 👤 Vista de Perfil de Usuario
Los usuarios registrados pueden ver y editar su propio perfil. Esta vista permite modificar sus datos personales y gestionar sus preferencias.

![Vista de perfil de usuario](![image](https://github.com/user-attachments/assets/d8021b08-3596-4723-8e1b-cbad42f4d9d0)
)


## Contribución
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature-nueva`).
3. Realiza los cambios y haz commit (`git commit -m 'Agrega nueva funcionalidad'`).
4. Sube los cambios (`git push origin feature-nueva`).
5. Abre un Pull Request.


## 👥 Colaboradores
- Creador: Pau Barón [@Paukkita]
- Participantes: Aún no hay colaboradores. ¡Anímate a contribuir! 🚀
