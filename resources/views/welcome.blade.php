<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTako · Social Feed</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar-layout.css') }}">
    <style>
        :root {
            --bg-main: #f9fafb;
            --bg-card: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --accent: #2563eb;
            --border: #e5e7eb;
        }
        body.social-feed {
            background-color: var(--bg-main);
            color: var(--text-main);
            margin: 0;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .feed-layout {
            display: grid;
            grid-template-columns: 260px 1fr 320px;
            min-height: 100vh;
        }
        /* Side Navigation (Matching your dashboard theme) */
        .feed-sidebar {
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: sticky;
            top: 0;
            height: 100vh;
            box-sizing: border-box;
        }
        .brand-logo {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-item:hover, .nav-item.active {
            background: #eff6ff;
            color: var(--accent);
        }
        /* Central Feed */
        .feed-main {
            padding: 2rem;
            max-width: 680px;
            width: 100%;
            margin: 0 auto;
        }
        .feed-header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .feed-header {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
        }
        .user-pill {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 0.4rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
        }
        /* Create Post Box (Visible when logged in) */
        .create-post-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .create-post-box textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.95rem;
            outline: none;
            resize: vertical;
            box-sizing: border-box;
            font-family: inherit;
        }
        .create-post-box textarea:focus {
            border-color: var(--accent);
        }
        /* Quote Post Card */
        .quote-post-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .post-author {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .post-caption {
            font-size: 0.95rem;
            margin-bottom: 1rem;
            color: var(--text-main);
        }
        /* Quote Graphic Box (Plain image style) */
        .quote-graphic {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            color: var(--text-main);
            text-decoration: none;
            display: block;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .quote-graphic:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);
        }
        .quote-text {
            font-size: 1.15rem;
            font-style: italic;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 1rem;
            color: #1e293b;
        }
        .quote-source {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--accent);
            font-weight: 700;
        }
        /* Right Sidebar Widgets */
        .feed-widgets {
            padding: 2rem 1.5rem;
            border-left: 1px solid var(--border);
            background: #fafaf9;
        }
        .widget-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
        }
    </style>
</head>
<body class="social-feed">

    <div class="feed-layout">
        <!-- Side Navigation Menu -->
        <aside class="feed-sidebar">
            <a href="{{ url('/') }}" class="brand-logo">🥔 BookTako</a>
            
            <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
                <a href="{{ url('/') }}" class="nav-item active">🏠 Home</a>
                <a href="#" class="nav-item">📥 Subscriptions</a>
                <a href="#" class="nav-item">💬 Chat</a>
                <a href="#" class="nav-item">🔔 Activity</a>
                <a href="#" class="nav-item">🔍 Explore</a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-item" style="margin-top: 1rem; border-top: 1px solid var(--border); padding-top: 1.5rem;">
                        📊 Dashboard
                    </a>
                @else
                    <div style="margin-top: 1rem; border-top: 1px solid var(--border); padding-top: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="{{ route('login') }}" class="nav-item">🔑 Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-item" style="background: var(--accent); color: #fff; justify-content: center;">Register</a>
                        @endif
                    </div>
                @endauth
            </nav>
        </aside>

        <!-- Central Timeline Feed -->
        <main class="feed-main">
            <div class="feed-header-area">
                <h1 class="feed-header">Home Feed</h1>
                @auth
                    <div class="user-pill">{{ auth()->user()->name }}</div>
                @endauth
            </div>

            <!-- CONDITIONAL POST CREATION BOX (Only for logged-in users) -->
            @auth
                <div class="create-post-box">
                    <form action="#" method="POST">
                        @csrf
                        <div style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.5rem; color: var(--text-main);">Share a Book Quote</div>
                        <textarea rows="3" placeholder="Write a caption or thoughts about this quote..."></textarea>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.75rem;">
                            <span style="font-size: 0.8rem; color: var(--text-muted);">Select a book & chapter to generate quote card</span>
                            <button type="button" class="btn-primary" style="padding: 0.4rem 1rem; font-size: 0.875rem;">Publish Post</button>
                        </div>
                    </form>
                </div>
            @endauth

            <!-- Example Quote Post Item 1 -->
            <div class="quote-post-card">
                <div class="post-author">
                    <span>🥔</span> <strong>PotatoAuthor</strong> · 2 hours ago
                </div>
                <div class="post-caption">
                    Just dropped a new chapter! This line really sets the tone for what's coming next.
                </div>

                <!-- Clickable Quote-to-Image Card linking straight to chapter reader route -->
                <a href="#" class="quote-graphic">
                    <div class="quote-text">
                        "The soil remembers every seed planted in despair, waiting for the quiet rain of persistence."
                    </div>
                    <div class="quote-source">
                        — BookTako Chronicles · Chapter 1: The Spud Awakens
                    </div>
                </a>
            </div>

            <!-- Example Quote Post Item 2 -->
            <div class="quote-post-card">
                <div class="post-author">
                    <span>📖</span> <strong>BookwormJane</strong> · Yesterday
                </div>
                <div class="post-caption">
                    Such an incredible twist in this chapter. Highly recommend checking it out!
                </div>
                <a href="#" class="quote-graphic">
                    <div class="quote-text">
                        "Not all roots grow downward; some reach straight into the stars."
                    </div>
                    <div class="quote-source">
                        — Roots & Leaves · Chapter 4
                    </div>
                </a>
            </div>
        </main>

        <!-- Right Sidebar Widgets -->
        <aside class="feed-widgets">
            <div class="widget-box">
                <h3 style="margin-top: 0; font-size: 1rem; font-weight: 700;">Trending Communities</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0;">#FantasyWriting #BookTakoCommunity #PotatoLover</p>
            </div>
        </aside>
    </div>

</body>
</html>