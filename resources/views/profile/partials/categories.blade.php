<!-- Streamer Categories Section -->
<div class="streamer-categories-setup-wrapper">
	<div class="streamer-categories-input">
	    <h4>What do you like to stream?</h4>
	    <span class="help-block">Select all that apply</span>
	    <form class="streamer-categories-input-form">
	        <div class="checkbox">
	            <label>
	            	@if ($gameDetails)
	            		<input type="checkbox" name="streamerType[]" value="1" checked="checked" class="checkbox-games"/>
	            		Games
            		@else
	                	<input type="checkbox" name="streamerType[]" value="1" class="checkbox-games"/>
	               		Games
               		@endif
	            </label>
	        </div>
	        <div class="checkbox">
	            <label>
	            	@if ($artDetails)
		                <input type="checkbox" name="streamerType[]" value="2" checked="checked" class="checkbox-art"/>
		                Art
	                @else
		                <input type="checkbox" name="streamerType[]" value="2" class="checkbox-art"/>
		                Art
	                @endif
	            </label>
	        </div>
	        <div class="checkbox">
	            <label>
	            	@if ($musicDetails)
		                <input type="checkbox" name="streamerType[]" value="3" checked="checked" class="checkbox-music"/>
		                Music
	                @else
		                <input type="checkbox" name="streamerType[]" value="3" class="checkbox-music"/>
		                Music
	                @endif
	            </label>
	        </div>
	        <div class="checkbox">
	            <label>
	            	@if ($buildingStuffDetails)
		                <input type="checkbox" name="streamerType[]" value="4" checked="checked" class="checkbox-building-stuff"/>
		                Building Stuff
	                @else
		                <input type="checkbox" name="streamerType[]" value="4" class="checkbox-building-stuff"/>
		                Building Stuff
	                @endif
	            </label>
	        </div>
	        <div class="checkbox">
	            <label>
	            	@if ($educationalDetails)
		                <input type="checkbox" name="streamerType[]" value="5" checked="checked" class="checkbox-educational"/>
		                Educational
	                @else
		                <input type="checkbox" name="streamerType[]" value="5" class="checkbox-educational"/>
		                Educational
	                @endif
	            </label>
	        </div>
	    </form>
	    <div class="streamer-categories-input-footer">
	    	<button type="button" class="btn btn-default streamer-categories-cancel">Cancel</button>    
	    	<button type="button" class="btn btn-global streamer-categories-input-submit">Next</button>
		</div>
	</div>

	<div class="streamer-categories-details">
	    <form class="streamer-categories-details-form">
	    </form>
	    <div class="streamer-categories-details-footer">
	    	<button type="button" class="btn btn-default streamer-categories-cancel">Cancel</button>
		    <button type="button" class="btn btn-global streamer-categories-details-submit">Next</button>
		</div>
	</div>

	<div class="streamer-categories-optional">
	    <h4>Additional Information</h4>
	    <span class="help-block">(This is optional)</span>
	    <form class="streamer-categories-optional-form">
	        <div class="form-group">
	        	@if ($systemSpecs)
	        		<textarea class="form-control system-specs input-global" name="system_specs" value="{{ $systemSpecs }}" rows="3"></textarea>
	        	@else
	           		<textarea class="form-control system-specs input-global" name="system_specs" placeholder="Let us know about your system specs" rows="3"></textarea>
	            @endif
	        </div>
	        <div class="form-group">
	        	@if ($streamSchedule)
	            	<textarea class="form-control stream-schedule input-global" name="stream_schedule" value="{{ $streamSchedule }}" rows="3"></textarea>
	            @else
	            	<textarea class="form-control stream-schedule input-global" name="stream_schedule" placeholder="Enter your streaming schedule" rows="3"></textarea>
	            @endif
	        </div>
	    </form>
		<div class="streamer-categories-optional-footer">
			<button type="button" class="btn btn-default streamer-categories-cancel">Cancel</button>
		    <button type="button" class="btn btn-global streamer-categories-optional-submit">Finish</button>
		</div>
	</div>
</div>

