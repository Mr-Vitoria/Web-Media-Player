<div class="sidebar active">
    <div class="sidebar-main active-main">
        <div class="sidebar-open ">
            <a href="#" class="fa-solid fa-bars"></a>
        </div>
        <div class="content">
            <h3 class="headerH">Search music:</h3>
            <div id="cover">
                <form method="get" action="/search">
                    <div class="tb">
                        <div class="td"><input type="text" placeholder="Search" name="text" required></div>
                        <div class="td" id="s-cover">
                            <button type="submit" name="btnSearch">
                                <div id="s-circle"></div>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <a class="btn btn-purple" href="/addMusic">Add new music</a>
        </div>
    </div>
</div>