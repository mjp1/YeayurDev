<div id="flash-overlay-modal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Welcome to Yeayur!</h3>
            </div>

            <!-- Modal Body Intro Content -->

            <div class="modal-body modal-body-intro">
                <p>Let's take a moment to set up your profile. You can also edit your information later by going to the Edit Profile page.</p>
            </div>
            <div class="modal-footer modal-footer-intro">
                <button type="button" class="btn btn-global modal-intro-btn">Let's Get Started!</button>
            </div>

            <!-- Modal Body Streamer Type Content -->

            <div class="modal-body modal-body-streamer-type">
                <h4>What do you like to stream?</h4>
                <span class="help-block">Select all that apply</span>
                <form>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="streamerType[]" value="1" class="checkbox-games"/>
                            Games
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="streamerType[]" value="2" class="checkbox-art"/>
                            Art
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="streamerType[]" value="3" class="checkbox-music"/>
                            Music
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="streamerType[]" value="4" class="checkbox-building-stuff"/>
                            Building Stuff
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="streamerType[]" value="5" class="checkbox-educational"/>
                            Educational
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-streamer-type">
                <button type="button" class="btn btn-global modal-streamer-type-btn">Next</button>
            </div>

            <!-- Modal Body Streamer Type Details -->

            <div class="modal-body modal-body-streamer-type-details">
                <form class="streamer-type-details-form">

                    <!-- Section if user chooses games -->


                </form>
            </div>
            <div class="modal-footer modal-footer-streamer-type-details">
                <button type="button" class="btn btn-global modal-streamer-type-details-btn">Next</button>
            </div>

            <!-- Optional user inputs for About Me, System Specs, and Stream Schedule -->

            <div class="modal-body modal-body-streamer-type-optional">
                <h4>Additional Information</h4>
                <span class="help-block">(This is optional)</span>
                <form>
                    <div class="form-group">
                        <textarea class="form-control about-me input-global" name="about_me" placeholder="Short quip about yourself" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control system-specs input-global" name="system_specs" placeholder="Let us know about your system specs" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control stream-schedule input-global" name="stream_schedule" placeholder="Enter your streaming schedule" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-streamer-type-optional">
                <button type="button" class="btn btn-global modal-streamer-type-optional-btn">Finish</button>
            </div>

        </div>
    </div>
</div>