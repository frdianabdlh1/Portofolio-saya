<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — @yield('title', 'Dashboard')</title>
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{--bg:#0f0f0f;--bg2:#161616;--bg3:#1e1e1e;--text:#ede9e0;--muted:#888;--accent:#c8b89a;--border:#222;--danger:#e24b4a;--success:#6dbe6d}
body{background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;display:flex;min-height:100vh}
a{color:inherit;text-decoration:none}

.sidebar{width:230px;background:var(--bg2);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;bottom:0;left:0;padding:2rem 1.2rem}
.sidebar-logo{font-size:1.2rem;font-weight:600;letter-spacing:.03em;margin-bottom:2.5rem;padding:0 .4rem}
.sidebar-logo span{color:var(--accent)}
.sidebar-section{font-size:.62rem;letter-spacing:.16em;text-transform:uppercase;color:var(--muted);margin-bottom:.6rem;margin-top:1.2rem;padding:0 .4rem}
.nav-item{display:flex;align-items:center;gap:.7rem;padding:.65rem .8rem;border-radius:6px;font-size:.85rem;color:var(--muted);transition:all .2s;margin-bottom:2px;cursor:pointer}
.nav-item:hover{background:var(--bg3);color:var(--text)}
.nav-item.active{background:var(--bg3);color:var(--text)}
.nav-item .badge{margin-left:auto;background:var(--danger);color:#fff;font-size:.65rem;padding:.15rem .45rem;border-radius:10px}
.nav-icon{font-size:1rem;width:18px;text-align:center}

.main{margin-left:230px;flex:1;display:flex;flex-direction:column}
.topbar{padding:1.2rem 2.5rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;background:var(--bg)}
.topbar-title{font-size:1rem;font-weight:500}
.topbar-user{font-size:.82rem;color:var(--muted)}
.content{padding:2.5rem;flex:1}

.btn-sm{font-size:.78rem;padding:.45rem 1rem;border:1px solid var(--border);color:var(--muted);background:transparent;border-radius:4px;cursor:pointer;font-family:inherit;transition:all .2s}
.btn-sm:hover{border-color:var(--accent);color:var(--text)}
.btn-primary{background:var(--accent);color:#0a0a0a;border-color:var(--accent)}
.btn-primary:hover{background:transparent;color:var(--accent)}
.btn-danger{background:transparent;border-color:rgba(226,75,74,.4);color:var(--danger)}
.btn-danger:hover{background:rgba(226,75,74,.1)}

.card{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:1.5rem}
.table{width:100%;border-collapse:collapse;font-size:.85rem}
.table th{text-align:left;padding:.8rem 1rem;font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);border-bottom:1px solid var(--border);font-weight:400}
.table td{padding:.9rem 1rem;border-bottom:1px solid var(--border);color:var(--muted)}
.table tr:last-child td{border-bottom:none}
.table tr:hover td{background:var(--bg3);color:var(--text)}
.badge-pub{font-size:.68rem;padding:.2rem .55rem;border-radius:3px;background:rgba(109,190,109,.12);color:var(--success);border:1px solid rgba(109,190,109,.2)}
.badge-draft{font-size:.68rem;padding:.2rem .55rem;border-radius:3px;background:rgba(136,136,136,.12);color:var(--muted);border:1px solid var(--border)}
.badge-unread{background:rgba(226,75,74,.12);color:var(--danger);border:1px solid rgba(226,75,74,.2)}
.form-group{display:flex;flex-direction:column;gap:.5rem;margin-bottom:1.2rem}
.form-label{font-size:.72rem;letter-spacing:.08em;text-transform:uppercase;color:var(--muted)}
.form-control{background:var(--bg3);border:1px solid var(--border);color:var(--text);padding:.75rem 1rem;font-size:.87rem;border-radius:6px;outline:none;font-family:inherit;transition:border-color .2s;width:100%}
.form-control:focus{border-color:var(--accent)}
.form-control::placeholder{color:#444}
textarea.form-control{resize:vertical;min-height:100px}
.form-check{display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:var(--muted)}
.alert-success{background:rgba(109,190,109,.1);border:1px solid rgba(109,190,109,.25);color:var(--success);padding:.9rem 1.2rem;border-radius:6px;font-size:.85rem;margin-bottom:1.5rem}
.alert-error{background:rgba(226,75,74,.1);border:1px solid rgba(226,75,74,.25);color:var(--danger);padding:.9rem 1.2rem;border-radius:6px;font-size:.85rem;margin-bottom:1.5rem}
.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem}
.page-header h1{font-size:1.3rem;font-weight:500}
.stat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;margin-bottom:2.5rem}
.stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:1.2rem}
.stat-label{font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.4rem}
.stat-value{font-size:2rem;font-weight:600;line-height:1}
.actions{display:flex;gap:.5rem}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">Rifqi <span>Admin</span></div>

  <div class="sidebar-section">Main</div>
  <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="nav-icon">⬡</span> Dashboard
  </a>

  <div class="sidebar-section">Portfolio</div>
  <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
    <span class="nav-icon">◈</span> Projects
  </a>
  <a href="{{ route('admin.certificates.index') }}" class="nav-item {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
    <span class="nav-icon">🏆</span> Certificates
  </a>

  <div class="sidebar-section">Inbox</div>
  <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
    <span class="nav-icon">✉</span> Messages
    @php $unread = \App\Models\Message::unread()->count() @endphp
    @if($unread > 0)<span class="badge">{{ $unread }}</span>@endif
  </a>
  <a href="{{ route('admin.comments.index') }}" class="nav-item {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
    <span class="nav-icon">💬</span> Comments
    @php $pending = \App\Models\Comment::where('is_approved',false)->count() @endphp
    @if($pending > 0)<span class="badge">{{ $pending }}</span>@endif
  </a>

  <div style="margin-top:auto">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="nav-item" style="width:100%;border:none;background:transparent;cursor:pointer">
        <span class="nav-icon">↩</span> Logout
      </button>
    </form>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <span class="topbar-title">@yield('title', 'Dashboard')</span>
    <span class="topbar-user">{{ auth()->user()->name }}</span>
  </div>
  <div class="content">
    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert-error">
        <ul style="list-style:none">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif
    @yield('content')
  </div>
</div>

</body>
</html>
