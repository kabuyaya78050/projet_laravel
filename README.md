# Évaluation — Mini Blog Laravel / Blade — Partie 2

**Module :** Développement Web avec Laravel
**Niveau :** L3 — Informatique et Logiciels
**Dépôt GitHub :** [Dr-Lab1/mini-blog-l3-il-part2](https://github.com/Dr-Lab1/mini-blog-l3-il-part2)

---

## Mise en place du projet

Avant de commencer l'évaluation, effectuez les étapes suivantes dans l'ordre :

```bash
# 1. Cloner le dépôt GitHub
git clone https://github.com/Dr-Lab1/mini-blog-l3-il-part2.git

# 2. Se déplacer dans le répertoire du projet
cd mini-blog-l3-il-part2

# 3. Installer les dépendances PHP
composer install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé de l'application
php artisan key:generate

# 6. Configurer la base de données dans le fichier .env
# puis exécuter les migrations et les seeders
php artisan migrate --seed

# 7. Exécuter cette commande pour install Laravel Breeze
composer require laravel/breeze --dev
```

> Assurez-vous d'avoir un **PHP 8+**, **Composer** et **Laravel** compatibles installés sur votre machine avant de commencer.

---

## Travail à réaliser

> **Note préliminaire :** Créez vos propres relations Eloquent entre les modèles si vous les jugez nécessaires pour réaliser les tâches ci-dessous.

---

### Question 1 — Page d'accueil

Dynamisez la page d'accueil en récupérant les données réelles depuis la base de données.

**Tâches :**

1. Afficher les **3 derniers articles** dans la section des articles mis en avant.

   ```php
   $articles = Post::limit(3)->orderByDesc('id')->get();
   // Récupère les 3 derniers articles dans l'ordre décroissant
   ```

2. Afficher **5 catégories** dans la section des catégories.

   ```php
   $categories = Category::limit(5)->get();
   // Récupère les 5 premières catégories dans l'ordre croissant
   ```

3. Afficher les **statistiques réelles** (nombre total d'articles, de catégories et de commentaires) dans la section des stats de la page d'accueil.

**Questions :**

1. Comment passe-t-on plusieurs variables à une vue depuis un contrôleur en une seule instruction ?
2. Dans la vue Blade, comment affiche-t-on la valeur d'une variable avec protection contre les failles XSS ?
3. Qu'est-ce que la directive `@foreach` en Blade et comment l'utilise-t-on pour afficher une liste d'articles ?

---

### Question 2 — Page Articles (publique)

Dynamisez la page de liste des articles.

**Tâches :**

1. N'afficher que les **10 derniers articles** dans la liste.

   ```php
   $articles = Post::limit(10)->orderByDesc('id')->get();
   ```

2. Remplacer le texte statique *"50 articles publiés dans 5 catégories"* par les **chiffres réels** issus de la base de données.

3. Afficher le **nombre total d'articles** et le **nombre total de catégories** dans la barre de statistiques de la page.

4. Dynamiser la section d'affichage des **catégories dans la sidebar** ou le filtre de la page.

**Questions :**

1. Quelle est la différence entre `Post::all()` et `Post::limit(10)->orderByDesc('id')->get()` ? Quand préfère-t-on l'une ou l'autre ?
2. Comment compte-t-on le nombre total d'enregistrements d'un modèle en Eloquent ?
3. Comment utilise-t-on `@forelse` en Blade et en quoi est-il plus pratique que `@foreach` lorsqu'une collection peut être vide ?

---

### Question 3 — Page Catégories (publique)

Dynamisez la page des catégories.

**Tâches :**

1. Afficher **toutes les catégories** avec, pour chacune, son **nombre d'articles** associés.

**Questions :**

1. Comment définit-on une relation `hasMany` entre un modèle `Category` et un modèle `Post` en Eloquent ?
2. Comment accède-t-on au nombre d'articles d'une catégorie dans une vue Blade — quelle est la différence entre `$category->posts->count()` et `$category->posts()->count()` ?
3. Qu'est-ce que le **chargement eager** (`with()`) et pourquoi est-il important pour éviter le problème des requêtes N+1 lors de l'affichage des catégories avec leur nombre d'articles ?

---

### Question 4 — Page À propos (publique)

Dynamisez la page à propos.

**Tâches :**

1. Afficher les **statistiques réelles** (nombre total d'articles, de catégories, d'utilisateurs ou de commentaires) dans la section statistiques.

2. Lister **tous les utilisateurs** dans la section équipe.

   ```php
   $users = User::all();
   ```

**Questions :**

1. Le modèle `User` existe déjà par défaut dans Laravel — dans quel fichier se trouve-t-il et quels attributs contient-il par défaut ?
2. Comment affiche-t-on conditionnellement un élément dans Blade — par exemple, n'afficher la liste des utilisateurs que si elle n'est pas vide ?
3. Qu'est-ce que la directive `@empty` en Blade ?

---

### Question 5 — Dashboard — Page Index

Dynamisez la page principale du tableau de bord.

**Tâches :**

1. Afficher les **statistiques réelles** dans les 4 cartes de statistiques (nombre d'articles, commentaires, utilisateurs, catégories).

2. Afficher les **7 derniers articles** dans le tableau de la section "Articles récents".

**Questions :**

1. Comment récupérer les 7 derniers articles insérés en base de données avec Eloquent ?
2. Comment accède-t-on à une colonne spécifique d'un objet Eloquent dans une vue Blade — par exemple le titre d'un article ?
3. Qu'est-ce que `$article->created_at` et comment le formater dans une vue Blade pour afficher une date lisible ?

---

### Question 6 — Dashboard — Articles

Dynamisez la page de gestion des articles dans le dashboard.

**Tâches :**

1. Afficher les **10 derniers articles** dans le tableau, avec pour chaque article : son titre, sa catégorie, son statut (publié ou brouillon), sa date de publication et son auteur.

**Questions :**

1. Comment récupérer les articles **avec leur catégorie associée** en une seule requête Eloquent (sans faire de requête supplémentaire pour chaque article) ?
2. Comment affiche-t-on le nom de la catégorie d'un article dans Blade si la relation `belongsTo` est définie sur le modèle `Post` ?
3. Qu'est-ce qu'un **accesseur** (`get...Attribute`) en Eloquent et dans quel cas pourrait-il être utile ici ?

---

### Question 7 — Dashboard — Catégories, Commentaires & Utilisateurs

Dynamisez les trois pages de gestion restantes du dashboard.

**Tâches :**

1. **Catégories** — Afficher toutes les catégories dans le tableau.
2. **Commentaires** — Afficher tous les commentaires dans la liste, avec pour chacun : son auteur, le titre de l'article concerné et sa date.
3. **Utilisateurs** — Afficher tous les utilisateurs dans le tableau.

**Questions :**

1. Comment définit-on une relation `belongsTo` entre un commentaire et un article en Eloquent ?
2. Dans la page des commentaires, comment affiche-t-on le titre de l'article auquel appartient un commentaire, en supposant que la relation est correctement définie ?
3. Quelle méthode Eloquent utilise-t-on pour récupérer **tous** les enregistrements d'une table sans condition ?

---

## Structure de fichiers concernés

Les fichiers que vous serez principalement amenés à modifier :

```
app/
├── Models/
│   ├── Post.php          ← Ajouter les relations si nécessaire
│   ├── Category.php      ← Ajouter les relations si nécessaire
│   ├── Comment.php       ← Ajouter les relations si nécessaire
│   └── User.php          ← Modèle existant
└── Http/
    └── Controllers/
        ├── MainController.php       ← Passer les données aux vues publiques
        └── DashboardController.php  ← Passer les données aux vues du dashboard

resources/views/
├── public/
│   ├── index.blade.php        ← Dynamiser
│   ├── articles.blade.php     ← Dynamiser
│   ├── categories.blade.php   ← Dynamiser
│   └── about.blade.php        ← Dynamiser
└── dashboard/
    ├── index.blade.php        ← Dynamiser
    ├── articles.blade.php     ← Dynamiser
    ├── categories.blade.php   ← Dynamiser
    ├── comments.blade.php     ← Dynamiser
    └── users.blade.php        ← Dynamiser
```

---

## Critères d'évaluation

| Critère | Points |
|---|---|
| Page d'accueil dynamisée (articles, catégories, stats) | 1.5 pt |
| Page articles dynamisée (liste, stats, catégories) | 1.5 pt |
| Page catégories dynamisée (liste + nombre d'articles) | 1 pt |
| Page à propos dynamisée (stats + utilisateurs) | 1 pt |
| Dashboard — Index dynamisé (stats + 7 derniers articles) | 1.5 pt |
| Dashboard — Articles dynamisé (10 derniers) | 1 pt |
| Dashboard — Catégories, Commentaires, Utilisateurs dynamisés | 1 pt |
| Réponses aux questions théoriques | 1.5 pt |
| **Total** | **10 pts** |

---

## Consignes générales

- Le travail est **individuel**.
- Soumettez votre travail en poussant votre code sur un dépôt GitHub **personnel** et en partageant le lien.
- Le dépôt doit contenir un fichier `.env.example` à jour mais **jamais** le fichier `.env` lui-même.
- Toute ressemblance de code entre deux rendus entraînera un **zéro** pour les deux parties concernées.
- Les réponses aux questions théoriques sont à rédiger directement dans ce fichier `README.md`, sous chaque question.

**Bonne évaluation !**


# 📘 RÉPONSES THÉORIQUES — LARAVEL BLOG & DASHBOARD

---

# ✅ QUESTION 1 — Page d’accueil

## Passer plusieurs variables à une vue

return view('page', compact('articles', 'categories'));

ou

return view('page', [
    'articles' => $articles,
    'categories' => $categories
]);

---

## Affichage sécurisé Blade (XSS)

{{ $variable }}

---

## @foreach

@foreach($articles as $article)
    {{ $article->title }}
@endforeach

---

# ✅ QUESTION 2 — Page Articles

## Différence Post::all() et limit()

Post::all() → récupère toutes les données
Post::limit(10)->orderByDesc('id')->get() → limite et optimise les résultats

---

## Compter les enregistrements

Post::count();

---

## @forelse

@forelse($articles as $article)
    {{ $article->title }}
@empty
    <p>Aucun article disponible</p>
@endforelse

---

# ✅ QUESTION 3 — Catégories

## Relation hasMany

public function posts()
{
    return $this->hasMany(Post::class);
}

---

## Différence count()

$category->posts->count() → charge tous les posts
$category->posts()->count() → requête SQL optimisée

---

## Eager loading (with)

Category::with('posts')->get();

---

# ✅ QUESTION 4 — Page À propos

## User model

app/Models/User.php

---

## Condition Blade

@if($users->isNotEmpty())
    ...
@endif

---

## @empty

@empty($users)
    <p>Aucun utilisateur</p>
@endempty

---

 ✅ QUESTION 5 — Dashboard Index

7 derniers articles

Post::latest()->limit(7)->get();

---

Afficher une colonne

{{ $article->title }}

---

created_at

{{ $article->created_at->format('d/m/Y') }}

---

✅ QUESTION 6 — Dashboard Articles

Relation optimisée

Post::with('category')->get();

---

 Afficher catégorie

{{ $article->category->name }}

---

Accesseur

public function getStatusTextAttribute()
{
    return $this->status ? 'Publié' : 'Brouillon';
}

---

  QUESTION 7 — Dashboard global

 belongsTo (Commentaire → Post)

public function post()
{
    return $this->belongsTo(Post::class);
}

---

Afficher article d’un commentaire

{{ $comment->post->title }}

---

 Récupérer tous les enregistrements

Model::all();

---
