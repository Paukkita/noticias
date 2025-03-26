# 📰  Proyecto Noticias - Ver noticias
## Estado: 🚧 En Desarrollo

## 📌 Descripción  
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

![Vista de registro de usuario](https://github.com/user-attachments/assets/ba5a1952-bdfb-4fc9-ad04-fe304579c57d)

## 🔐 Vista de Login de Usuario
Los usuarios existentes pueden iniciar sesión proporcionando su nombre de usuario y contraseña. Esta vista garantiza un acceso seguro a la plataforma.

![Vista de login de usuario](https://github.com/user-attachments/assets/aa20fd43-d2b4-423b-b27d-e13e54c96d95)

## ⚠️ Vista de Errores de Validación
Si los datos proporcionados durante el registro o el login no son correctos, se muestran los errores correspondientes para corregir la información.

![Vista de errores de validación](https://github.com/user-attachments/assets/91902f2f-2047-43c8-b1d6-75870e0e319b)

## 📰 Vista de Noticias sin Iniciar Sesión
Los usuarios no autenticados pueden ver una lista de noticias, pero tienen un acceso limitado en comparación con los usuarios registrados.

![Vista de noticias sin loggear](https://github.com/user-attachments/assets/1a51587e-5ad1-428c-8fc5-d97c467bb7d4)

## 📝 Vista de Noticias como Admin
Los administradores (periodistas) tienen un acceso completo para gestionar las noticias. Pueden ver todas las publicaciones creadas y realizar acciones como crear, editar o eliminar noticias.

![Vista de noticias como admin](https://github.com/user-attachments/assets/9bb744b9-56d5-4b1d-86ad-e4e0ba304a4d)

## 👍 Vista de Usuario con "Me Gusta"
Los usuarios pueden interactuar con las noticias dando "me gusta" a sus publicaciones favoritas. Esta vista muestra las noticias que un usuario ha marcado como favoritas.

![Vista de usuario con me gusta](https://github.com/user-attachments/assets/d1e401e3-7f41-41cd-8499-8fedbe5e1284)

## 📰 Vista de Noticia Individual
Cada noticia tiene su propia página detallada donde se puede leer la publicación completa y ver la información adicional de la misma.

![Vista de noticia individual](https://github.com/user-attachments/assets/d0d66f63-a749-4ee6-8b43-2425266c5ea2)

## ✏️ Vista de Edición de una Noticia
El administrador puede editar cualquier noticia publicada. Esta vista permite modificar el contenido, título, género, etc., de una noticia existente.

![Vista de edición de una noticia](https://github.com/user-attachments/assets/6e5f63f2-c407-4473-bb86-9f503046dc21)

## 👥 Vista de Todos los Usuarios
Como administrador, se puede acceder a una lista completa de los usuarios registrados. Esta vista muestra los detalles básicos de cada usuario.

![Vista de todos los usuarios](https://github.com/user-attachments/assets/f4b53cc6-be61-4683-837c-3e97ec180b1a)

## ✏️ Vista de Edición de Usuario
El administrador tiene la capacidad de editar la información de los usuarios registrados, como sus datos personales y de contacto.

![Vista de edición de usuario](https://github.com/user-attachments/assets/12cee33e-f9cc-4517-aa39-bbf86304d48b)

## 👤 Vista de Perfil de Usuario
Los usuarios registrados pueden ver y editar su propio perfil. Esta vista permite modificar sus datos personales y gestionar sus preferencias.

![Vista de perfil de usuario](https://github.com/user-attachments/assets/c205deb2-d7e4-43c2-9c09-31d46c8fc82e)


## Contribución
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature-nueva`).
3. Realiza los cambios y haz commit (`git commit -m 'Agrega nueva funcionalidad'`).
4. Sube los cambios (`git push origin feature-nueva`).
5. Abre un Pull Request.


## 👥 Colaboradores
- Creador: Pau Barón [@Paukkita]
- Participantes: Aún no hay colaboradores. ¡Anímate a contribuir! 🚀
