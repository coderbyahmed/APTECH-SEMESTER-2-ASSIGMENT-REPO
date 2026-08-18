<!-- Search User Modal -->
<div class="search-backdrop" id="searchModal">
    <div class="search-box">
        <h2 class="search-title">Find User</h2>
        <p class="search-desc">Search a user by User ID or Email.</p>

        <form action="../process/search_process.php" method="POST" id="searchForm">

            <div class="search-input-group">
                <label for="searchQuery">Search</label>
                <input type="text" name="search_query" id="searchQuery"
                    placeholder="Search by User ID or Email"
                    autocomplete="off">
                <span class="search-field-error" id="searchError" style="display:none">
                    <svg class="search-field-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Please enter a User ID or Email.
                </span>
            </div>

            <div class="search-btn-group">
                <button type="button" class="btn-search-cancel" id="searchCancel">Cancel</button>
                <button type="submit" name="search_submit" class="btn-search-submit">Search</button>
            </div>

        </form>
    </div>
</div>
