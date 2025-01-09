#!/bin/bash

# Repository URL
REPO_URL="https://github.com/sccity/firecommand.git"
INSTALL_DIR="firecommand"

echo "🚀 Starting setup process..."

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "❌ Git is not installed. Please install git first."
    exit 1
fi

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install composer first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install Node.js and npm first."
    exit 1
fi

# Clone the repository if not already in the directory
if [ ! -d ".git" ]; then
    echo "📥 Cloning repository..."
    if [ -d "$INSTALL_DIR" ]; then
        echo "⚠️ Directory $INSTALL_DIR already exists."
        read -p "Would you like to remove it and clone again? (y/n) " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            rm -rf "$INSTALL_DIR"
        else
            echo "❌ Setup cancelled."
            exit 1
        fi
    fi
    git clone "$REPO_URL" "$INSTALL_DIR"
    cd "$INSTALL_DIR"
else
    echo "✅ Already in repository directory"
fi

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install

# Copy environment file if it doesn't exist
if [ ! -f .env ]; then
    echo "📄 Creating environment file..."
    cp .env.example .env
    
    # Generate application key
    echo "🔑 Generating application key..."
    php artisan key:generate
fi

# Build assets
echo "🔨 Building assets..."
npm run build

# Database setup
read -p "Would you like to setup the database (migrations and seeders)? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "🗄️ Setting up SQLite database..."
    # Create database directory if it doesn't exist
    mkdir -p database/seeders
    # Create empty SQLite database file
    touch database/database.sqlite
    
    # Update .env file to use SQLite
    sed -i '' 's/DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
    sed -i '' 's/DB_DATABASE=.*/DB_DATABASE=database\/database.sqlite/' .env
    
    # Create RolesAndPermissionsSeeder if it doesn't exist
    if [ ! -f "database/seeders/RolesAndPermissionsSeeder.php" ]; then
        echo "📝 Creating RolesAndPermissionsSeeder..."
        cat > database/seeders/RolesAndPermissionsSeeder.php << 'EOL'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage fires']);
        Permission::create(['name' => 'manage assignments']);
        Permission::create(['name' => 'view fires']);
        Permission::create(['name' => 'create fires']);
        Permission::create(['name' => 'edit fires']);
        Permission::create(['name' => 'delete fires']);

        // Create roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $commander = Role::create(['name' => 'commander']);
        $commander->givePermissionTo([
            'manage fires',
            'manage assignments',
            'view fires',
            'create fires',
            'edit fires'
        ]);

        $dispatcher = Role::create(['name' => 'dispatcher']);
        $dispatcher->givePermissionTo([
            'view fires',
            'create fires',
            'edit fires'
        ]);
    }
}
EOL
    fi

    # Create UserSeeder if it doesn't exist
    if [ ! -f "database/seeders/UserSeeder.php" ]; then
        echo "📝 Creating UserSeeder..."
        cat > database/seeders/UserSeeder.php << 'EOL'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');
    }
}
EOL
    fi
    
    echo "🗄️ Running database migrations..."
    php artisan migrate:fresh
    
    echo "🌱 Running database seeders..."
    php artisan db:seed --class=RolesAndPermissionsSeeder
    php artisan db:seed --class=UserSeeder
fi

# Start the server
echo "🌐 Starting the server..."
php artisan serve