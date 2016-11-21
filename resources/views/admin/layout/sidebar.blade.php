<div id="sidebar-menu" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <a href="{{url("/")}}" target="_blank">Show Website</a>
    </form>
    <ul class="nav menu">
        <li ><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#menus"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> CMS Management
            </a>
            <ul class="children collapse" id="menus">
                <li>
                    <a href="{{route('menu.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Menu Listing</a>
                </li>
                <li>
                    <a href="{{route('menu.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add New Menu
                    </a>
                </li>
            </ul>            
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#teams"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Team Management
            </a>
            <ul class="children collapse" id="teams">
                <li>
                    <a href="{{route('team.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Our Team</a>
                </li>
                <li>
                    <a href="{{route('team.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add New Member
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#slogans"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Home Slider Slogans
            </a>
            <ul class="children collapse" id="slogans">
                <li>
                    <a href="{{route('slogan.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Slogan Listing</a>
                </li>
                <li>
                    <a href="{{route('slogan.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add new Slogan
                    </a>
                </li>
            </ul>            
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#services"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Our Services
            </a>
            <ul class="children collapse" id="services">
                <li>
                    <a href="{{route('service.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Services</a>
                </li>
                <li>
                    <a href="{{route('service.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Service
                    </a>
                </li>
            </ul>            
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#workflow"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Services Work Flows
            </a>
            <ul class="children collapse" id="workflow">
                <li>
                    <a href="{{route('workflow.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Work Flows</a>
                </li>
                <li>
                    <a href="{{route('workflow.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> New Work Flow</a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#news"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> News
            </a>
            <ul class="children collapse" id="news">
                <li>
                    <a href="{{route('news.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> News </a>
                </li>
                <li>
                    <a href="{{route('news.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New News</a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#office"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Offices
            </a>
            <ul class="children collapse" id="office">
                <li>
                    <a href="{{route('office.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Offices</a>
                </li>
                <li>
                    <a href="{{route('office.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Office
                    </a>
                </li>
                <li>
                    <a href="{{route('office.images')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Office Images
                    </a>
                </li>
                <li>
                    <a href="{{route('office.images.show')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Show Office Images
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#project"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Projects
            </a>
            <ul class="children collapse" id="project">
                <li>
                    <a href="{{route('project.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Projects</a>
                </li>
                <li>
                    <a href="{{route('project.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Project
                    </a>
                </li>
            </ul>     
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#states"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                States
            </a>
            <ul class="children collapse" id="states">
                <li>
                    <a href="{{route('state.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> States</a>
                </li>
                <li>
                    <a href="{{route('state.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add New State
                    </a>
                </li>
            </ul>
        </li>

        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#districts"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Districts
            </a>
            <ul class="children collapse" id="districts">
                <li>
                    <a href="{{route('districts.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Districts</a>
                </li>
                <li>
                    <a href="{{route('districts.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add New District
                    </a>
                </li>
            </ul>
        </li>


        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#cities"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Cities
            </a>
            <ul class="children collapse" id="cities">
                <li>
                    <a href="{{route('city.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cities</a>
                </li>
                <li>
                    <a href="{{route('city.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add New City
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#networks"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Networks
            </a>
            <ul class="children collapse" id="networks">
                <li>
                    <a href="{{route('network.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Routes</a>
                </li>
                <li>
                    <a href="{{route('network.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Route
                    </a>
                </li>
            </ul>     
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#openings"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Current Openings
            </a>
            <ul class="children collapse" id="openings">
                <li>
                    <a href="{{route('current-opening.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Openings</a>
                </li>
                <li>
                    <a href="{{route('current-opening.create')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Opening
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#albums"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Albums
            </a>
            <ul class="children collapse" id="albums">
                <li>
                    <a href="{{route('albums.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Albums</a>
                </li>
                <li>
                    <a href="{{route('album.save.images')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Create New Album
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#partners"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Partners
            </a>
            <ul class="children collapse" id="partners">
                <li>
                    <a href="{{route('partners.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Partners</a>
                </li>
                <li>
                    <a href="{{route('partners.save.images')}}">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Partners
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent ">
            <a href="javascript:void(0);">
                <span data-toggle="collapse" href="#configuration"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>
                Site Configuration
            </a>
            <ul class="children collapse" id="config">
                <li>
                    <a href="{{route('config.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Configuration</a>
                </li>
            </ul>
        </li>
        <form role="separation"></form>
        <li class="parent " id="career">
            <a href="{{route('career.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg></span>
                Careers Request
            </a>
        </li>        
        <li class="parent " id="inquiry">
            <a href="{{route('inquiry.list')}}"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg></span>
                Manage Inquiries
            </a>
        </li>
        <li class="parent " id="seo">
            <a href="{{route('admin.seo')}}">
                <span data-toggle="collapse" ><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg></span> SEO Management
            </a>
        </li>
    </ul>
</div><!--/.sidebar-->
