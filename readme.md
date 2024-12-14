# Jak spustit aplikaci

## Kroky instalace a spuštění

1. **Naklonovat si appku**
    - Použijte `git clone <URL_REPOZITÁŘE>` pro stažení aplikace do lokálního počítače.

2. **Dostat se do repozitáře `/recepty`**
    - Přesuňte se do složky pomocí `cd recepty`.

3. **Nainstalovat PHP**
    - Stáhněte si PHP z: [windows.php.net/download/](https://windows.php.net/download/).
    - Ověřte funkčnost v konzoli příkazem:
      ```bash
      php -v
      ```

4. **Nainstalovat Node.js**
    - Stáhněte si Node.js z: [nodejs.org/en](https://nodejs.org/en).
    - Ověřte funkčnost v konzoli příkazem:
      ```bash
      node -v
      ```

5. **Nainstalovat Composer**
    - Stáhněte Composer z: [getcomposer.org/download/](https://getcomposer.org/download/).
    - Composer funguje pouze pokud máte funkční PHP.
    - Ověřte funkčnost v konzoli příkazem:
      ```bash
      composer -v
      ```

6. **Nainstalovat MySQL**
    - Stáhněte MySQL z: [dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/).
    - Ověřte funkčnost v konzoli příkazem:
      ```bash
      mysql -v
      ```

7. **Spustit databázi**
    - Otevřete konzoli a spusťte příkazy:
      ```bash
      net stop MySQL
      net start MySQL
      mysql -u root -p
      ```
    - Heslo pro přístup najdete v souboru `.env`.

8. **Spustit backend (Laravel)**
    - Spusťte následující příkazy v konzoli:
      ```bash
      composer install
      php artisan migrate
      php artisan db:seed
      php artisan serve
      ```

9. **Spustit frontend (Tailwind CSS)**
    - Spusťte následující příkazy v konzoli:
      ```bash
      npm install
      npm run dev
      ```

10. **Otevřít aplikaci v prohlížeči**
    - Zadejte adresu: [http://127.0.0.1:8000](http://127.0.0.1:8000) nebo [http://localhost:8000](http://localhost:8000).

---

## Kde se nachází naimplementované funkcionality

### **Práva**
- **Soubory**: `Policies/RecipePolicy` a `Providers/AuthServiceProvider`.
- **Popis**:
    - V `AuthServiceProvider` je model `Recipe` mapován na `RecipePolicy`.
    - `RecipePolicy` definuje pravidla pro úpravy a mazání receptů pouze pro jejich vlastníka (`user_id`).

### **Migrace**
- **Složka**: `database/migrations`.
- **Popis**:
    - Obsahuje definice tabulek pro databázi (např. `recipes`, `allergens`, `categories`).
    - Migrace tvoří strukturu databáze, nikoli data.

### **Seedery**
- **Složka**: `database/seeders`.
- **Popis**:
    - Slouží k naplnění databáze výchozími daty (např. kategorie, recepty, uživatelé).

### **Modely**
- **Složka**: `App\Models`.
- **Popis**:
    - Třídy, které reprezentují tabulky v databázi. Obsahují i relace (např. `N:1`, `N:N`).
    - Model `Recipe` zahrnuje např. název, popis, obrázek, kategorii, ingredience, atd.

### **Obrázky**
- **Složka**: `public/storage`.
- **Popis**:
    - Obrázky receptů se ukládají do složky `public/storage/recipes_images`.

### **Kontrolery**
- **Složka**: `App\Http\Controllers`.
- **Popis**:
    - Obsahují metody pro zpracování požadavků uživatelů (např. vytvoření, úprava, mazání receptů).

### **CSS (Tailwind)**
- **Složka**: `resources/css`.
- **Popis**:
    - Obsahuje styly vytvořené pomocí frameworku **Tailwind CSS**, který poskytuje předdefinované třídy i jen obyč CSS.

### **Blade šablony**
- **Složka**: `resources/views`.
- **Popis**:
    - Obsahuje šablony pro zobrazení (např. receptů, kategorií) s využitím syntaxe Blade. Je to dost podobné HTML, ale s možností vkládat PHP kód.

### **Webové routy**
- **Soubor**: `routes/web.php`.
- **Popis**:
    - Definuje URL adresy pro zobrazení a práci s aplikací (např. přidání receptu, editace, zobrazení kategorie).

### **API routy**
- **Soubor**: `routes/api.php`.
- **Popis**:
    - Obsahuje routy určené pro API, které vrací data ve formátu JSON (např. vyhledávání receptů).
