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
                <form>

                    <!-- Section if user chooses games -->

                    <div class="form-group detail-inputs detail-input-games detail-input-1">
                        <h4>Let us know the games you like to play!</h4>
                        <h6 class="help-block">(Use keywords to describe such as the game's title or genre)</h6>
                        <div class="form-group">
                            <input type="text" name="typeDetails[games]" class="form-control input-global"/>
                            <input type="text" name="typeDetails[art]" class="form-control input-global"/>
                        </div>
                        <!-- Button to add more inputs for additional keywords -->
                        <div class="add-more add-more-games">
                            <button type="button" class="btn btn-global">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <span>Add more</span>
                        </div> 
                    </div>

                    <!-- Section if user chooses art -->

                    <div class="form-group detail-inputs detail-input-art detail-input-2">
                        <h4>Let us know about your art!</h4>
                        <h6 class="help-block">(Use keywords to describe such as drawing, painting, or the style)</h6>
                        <div class="form-group">
                            <input type="text" name="artInfo[]" class="form-control input-global"/>
                        </div>
                        <!-- Button to add more inputs for additional keywords -->
                        <div class="add-more add-more-art">
                            <button type="button" class="btn btn-global">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <span>Add more</span>
                        </div>
                    </div>

                    <!-- Section if user chooses music -->

                    <div class="form-group detail-inputs detail-input-music detail-input-3">
                        <h4>Let us know about the music you like!</h4>
                        <h6 class="help-block">(Use keywords to describe such as the singer, group, or genre)</h6>
                        <div class="form-group">
                            <input type="text" name="musicInfo[]" class="form-control input-global"/>
                        </div>
                        <!-- Button to add more inputs for additional keywords -->
                        <div class="add-more add-more-music">
                            <button type="button" class="btn btn-global">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <span>Add more</span>
                        </div>
                    </div>

                    <!-- Section if user chooses building stuff -->

                    <div class="form-group detail-inputs detail-input-buildingstuff detail-input-4">
                        <h4>Let us know what you like to build!</h4>
                        <h6 class="help-block">(Use keywords to describe such as models, PC building, or cosplay)</h6>
                        <div class="form-group">
                            <input type="text" name="buildingStuffInfo[]" class="form-control input-global"/>
                        </div>
                        <!-- Button to add more inputs for additional keywords -->
                        <div class="add-more add-more-buildingstuff">
                            <button type="button" class="btn btn-global">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <span>Add more</span>
                        </div>
                    </div>

                    <!-- Section if user chooses educational -->

                    <div class="form-group detail-inputs detail-input-educational detail-input-5">
                        <h4>Let us know about the topics you like to discuss!</h4>
                        <h6 class="help-block">(Use keywords to describe such as the topic or subject matter)</h6>
                        <div class="form-group">
                            <input type="text" name="educationalInfo[]" class="form-control input-global"/>
                        </div>
                        <!-- Button to add more inputs for additional keywords -->
                        <div class="add-more add-more-educational">
                            <button type="button" class="btn btn-global">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <span>Add more</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-streamer-type-details">
                <button type="button" class="btn btn-global modal-streamer-type-details-btn">Finish</button>
            </div>

        </div>
    </div>
</div>
