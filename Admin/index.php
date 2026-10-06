<?php
 session_start();
 include '../connection.php';

if(!isset($_SESSION['userid'])|| $_SESSION['Role'] !== 'Admin')
{
  header("Location:../Login.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Panel</title>
<style>
:root{--side:#1d2b3a;--bg:#f2f4f7;--line:#e2e7ee;--ink:#1b2430;--muted:#6b7887;--accent:#0f8b8d;--danger:#c8423b}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:"Segoe UI",system-ui,sans-serif;background:var(--bg);color:var(--ink);display:flex;min-height:100vh}
a{text-decoration:none;color:inherit}

/* Sidebar */
.side{width:240px;background:var(--side);padding:24px 16px;flex-shrink:0}
.brand{color:#fff;font-size:20px;font-weight:700;padding:0 10px 22px}
.group{color:#7f90a3;font-size:13px;padding:14px 12px 6px}
.side a{display:block;color:#b9c6d4;padding:10px 12px;border-radius:8px;margin-bottom:3px;font-size:15px}
.side a:hover{background:rgba(255,255,255,.08);color:#fff}
.side a.logout{margin-top:24px;border-top:1px solid rgba(255,255,255,.12);border-radius:0;padding-top:16px}

/* Active link (no JavaScript) */
body:not(:has(.sec:target)) a[href="#dashboard"],
body:has(#add-product:target) a[href="#add-product"],
body:has(#view-products:target) a[href="#view-products"],
body:has(#add-category:target) a[href="#add-category"],
body:has(#view-categories:target) a[href="#view-categories"],
body:has(#view-users:target) a[href="#view-users"]{background:var(--accent);color:#fff}

/* Sections: sirf wohi dikhega jis link par click hua */
.main{flex:1;min-width:0;padding:28px 32px}
.sec{display:none}
.sec:target{display:block}
.main:not(:has(.sec:target)) #dashboard{display:block}
h1{font-size:26px;margin-bottom:20px}

.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px}
.card{background:#fff;border:1px solid var(--line);border-left:4px solid var(--accent);border-radius:10px;padding:18px 20px}
.card span{color:var(--muted);font-size:14px}
.card strong{display:block;font-size:30px;margin-top:4px}

.box{background:#fff;border:1px solid var(--line);border-radius:10px;padding:22px}
form{max-width:560px}
label{display:block;font-size:14px;font-weight:600;margin:14px 0 6px}
label:first-child{margin-top:0}
input,select,textarea{width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:8px;font:inherit;font-size:14px;background:#fff}
textarea{min-height:90px;resize:vertical}
:focus-visible{outline:3px solid #7ec8c9;outline-offset:1px}
button{margin-top:20px;padding:10px 20px;border:0;border-radius:8px;background:var(--accent);color:#fff;font:inherit;font-size:15px;cursor:pointer}
.row{display:grid;grid-template-columns:1fr 1fr;gap:14px}

.scroll{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:14px}
th,td{padding:12px 16px;text-align:left;border-bottom:1px solid var(--line);white-space:nowrap}
th{background:#fafbfc;color:var(--muted)}
tr:last-child td{border-bottom:0}
.edit{color:var(--accent);margin-right:12px}
.del{color:var(--danger)}
.pill{padding:3px 10px;border-radius:99px;font-size:12px;font-weight:600;background:#e8ecf2;color:#4a5665}
.pill.admin{background:#dcefef;color:#0b6062}

@media(max-width:800px){
  body{flex-direction:column}
  .side{width:100%;padding:12px;display:flex;flex-wrap:wrap;gap:4px;align-items:center}
  .brand{width:100%;padding:0 4px 8px}
  .group{display:none}
  .side a{margin:0}
  .side a.logout{margin:0;border:0;padding:10px 12px}
  .main{padding:20px 16px}
  .row{grid-template-columns:1fr}
}
</style>
</head>
<body>

<nav class="side">
  <div class="brand">Admin Panel</div>
  <a href="#dashboard">Dashboard</a>

  <div class="group">Products</div>
  <a href="#add-product">Add product</a>
  <a href="#view-products">View products</a>

  <div class="group">Categories</div>
  <a href="#add-category">Add category</a>
  <a href="#view-categories">View categories</a>

  <div class="group">Users</div>
  <a href="#view-users">View users</a>

  <a href="logout.php" class="logout">Logout</a>
</nav>

<div class="main">

  <!-- Dashboard -->
  <section class="sec" id="dashboard">
    <h1>Dashboard</h1>
    <div class="cards">
      <div class="card"><span>Products</span><strong>24</strong></div>
      <div class="card"><span>Categories</span><strong>6</strong></div>
      <div class="card"><span>Users</span><strong>58</strong></div>
    </div>
  </section>

  <!-- Add product -->
  <section class="sec" id="add-product">
    <h1>Add product</h1>
    <div class="box">
      <form method="POST" action="add_product.php" enctype="multipart/form-data">
        <label for="pname">Product name</label>
        <input type="text" id="pname" name="name" required>

        <label for="pcat">Category</label>
        <select id="pcat" name="category_id" required>
          <option value="">Select category</option>
          <option value="1">Electronics</option>
          <option value="2">Clothing</option>
          <option value="3">Books</option>
        </select>

        <div class="row">
          <div>
            <label for="pprice">Price</label>
            <input type="number" id="pprice" name="price" min="0" step="0.01" required>
          </div>
          <div>
            <label for="pstock">Stock</label>
            <input type="number" id="pstock" name="stock" min="0" required>
          </div>
        </div>

        <label for="pdesc">Description</label>
        <textarea id="pdesc" name="description"></textarea>

        <label for="pimg">Product image</label>
        <input type="file" id="pimg" name="image" accept="image/*">

        <button type="submit">Add product</button>
      </form>
    </div>
  </section>

  <!-- View products -->
  <section class="sec" id="view-products">
    <h1>View products</h1>
    <div class="box scroll" style="padding:0">
      <table>
        <thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Wireless Mouse</td><td>Electronics</td><td>1,500</td><td>40</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
          <tr><td>2</td><td>Cotton T-Shirt</td><td>Clothing</td><td>1,200</td><td>85</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
          <tr><td>3</td><td>PHP Basics</td><td>Books</td><td>900</td><td>15</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Add category -->
  <section class="sec" id="add-category">
    <h1>Add category</h1>
    <div class="box">
      <form method="POST" action="category.php">
        <label for="cname">Category name</label>
        <input type="text" id="cname" name="name" required>

        <label for="cdesc">Description</label>
        <textarea id="cdesc" name="description"></textarea>

        <button type="submit">Add category</button>
      </form>
    </div>
  </section>

  <!-- View categories -->
  <section class="sec" id="view-categories">
    <h1>View categories</h1>
    <div class="box scroll" style="padding:0">
      <table>
        <thead><tr><th>ID</th><th>Name</th><th>Products</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Electronics</td><td>10</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
          <tr><td>2</td><td>Clothing</td><td>8</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
          <tr><td>3</td><td>Books</td><td>6</td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- View users -->
  <section class="sec" id="view-users">
    <h1>View users</h1>
    <div class="box scroll" style="padding:0">
      <table>
        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Ali Khan</td><td>ali@example.com</td><td><span class="pill admin">admin</span></td>
              <td><a href="#" class="edit">Edit</a></td></tr>
          <tr><td>2</td><td>Sara Ahmed</td><td>sara@example.com</td><td><span class="pill">user</span></td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
          <tr><td>3</td><td>Usman Raza</td><td>usman@example.com</td><td><span class="pill">user</span></td>
              <td><a href="#" class="edit">Edit</a><a href="#" class="del">Delete</a></td></tr>
        </tbody>
      </table>
    </div>
  </section>

</div>
</body>
</html>