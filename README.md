# SpendWise 🚀

**SpendWise** es un sistema de control de gastos diseñado para ayudarte a gestionar tus finanzas de manera inteligente y eficiente. Con **SpendWise**, podrás registrar tus gastos, ingresos, presupuestos y ahorros, además de manejar pagos recurrentes y categorizar tus transacciones para tener un control total sobre tu dinero.

---

## Características Principales ✨

- **Registro de Gastos:** Registra y categoriza tus gastos diarios para mantener un historial detallado.
- **Control de Ingresos:** Lleva un seguimiento de tus ingresos y compáralos con tus gastos.
- **Presupuestos:** Establece límites de gastos por categoría y recibe alertas cuando te acerques a ellos.
- **Ahorros:** Define metas de ahorro y realiza un seguimiento de tu progreso.
- **Pagos Recurrentes:** Gestiona suscripciones, préstamos o compras a plazos con facilidad.
- **Reportes y Gráficos:** Visualiza tus finanzas con gráficos intuitivos y reportes detallados.
- **Seguridad:** Tus datos están protegidos con cifrado y autenticación segura.

---

## Tecnologías Utilizadas 🛠️

- **Backend:** Laravel.
- **Frontend:** Livewire, Tailwind CSS.
- **Autenticación:** Sanctum.

---

## Instalación y Uso 🚀

### Requisitos Previos

- PHP >= 8.4
- Composer >= 2.8.6
- Node.js >= 20.17
- NPM >= 11.0.1
- Laravel 12.x
- MySQL or any other compatible database

## Pasos para Instalar

1. Clonamos el repositorio
```bash
    git clone https://github.com/cofeeblcks/spend_wise.git
    gh repo clone cofeeblcks/spend_wise
```

2. Nos movemos a la carpeta del proyecto
``` bash
    cd spend_wise
```

3. Instalamos todas las dependencias de nodejs
```bash
    npm install
```

4. Instalamos las dependencias del composer
```bash
    composer install
```

5. Copiamos el archivo de variables
``` bash
    cp .env.example .env
```

6. Configuramos las variables de entorno con la conexion a la base de datos en el archivo **.env**
``` bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
```

7. Generamos una key para la aplicacion
``` bash
    php artisan key:generate
```

8. Linkeamos la carpeta de almacenamiento
``` bash
    php artisan storage:link
```

9. Realizamos la migracion de la base de datos
```bash
    php artisan migrate --seed
```

10. Por ultimos ejecutamos el servidor de laravel y nodejs
```bash
    php artisan serve
    npm run dev
```
---

## 🔗 Autores

- Hadik Chavez | [@cofeeblcks](https://github.com/cofeeblcks) | [![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/chavezhadik/)

---

# Contribuir 🤝

¡Las contribuciones son bienvenidas! Si deseas mejorar SpendWise, sigue estos pasos:

- Haz un fork del repositorio.

- Crea una rama con tu nueva funcionalidad (git checkout -b feature/nueva-funcionalidad).

- Realiza tus cambios y haz commit (git commit -m 'Añade nueva funcionalidad').

- Sube tus cambios (git push origin feature/nueva-funcionalidad).

- Abre un Pull Request y describe tus cambios.

# Licencia 📄
Este proyecto está bajo la licencia Apache.
