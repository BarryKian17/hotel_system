<div class="team-area-three pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">TEAM</span>
            <h2>Let's Meet Up With Our Special Team Members</h2>
        </div>
        <div class="team-slider-two owl-carousel owl-theme pt-45">
            @foreach ($team as $t)
            <div class="team-item">
                <a href="team.html">
                    <img src="{{ asset($t->image) }}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">{{ $t->name }}</a></h3>
                    <span>{{ $t->position }}</span>
                    <ul class="social-link">
                        <li>
                            <a href="{{ $t->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
