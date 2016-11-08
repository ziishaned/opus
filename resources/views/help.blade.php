@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin-top: 0; font-size: 17px;">Shortcuts</h3>
            <hr>
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-pills" role="tablist" id="help-tabs">
                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">General</a></li>
                <li><a href="#tab2" role="tab" data-toggle="tab">Editor</a></li>
            </ul>
            <!-- TAB CONTENT -->
            <div class="tab-content">
                <div class="active tab-pane fade in" id="tab1">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h3 style="font-size: 17px;">Global Shortcuts</h3>
                            <hr>
                            <table class="table table-bordered table-condensed">
                            	<thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Key Combinations</th>
                                    </tr>
                                </thead>
                                <tbody>
                            		<tr>
                            			<td>Open Shortcut Help</td>
                            			<td><kbd>h</kbd></td>
                            		</tr>
                                    <tr>
                                        <td>Go to Dashboard</td>
                                        <td>
                                            <ul class="list-inline list-unstyled" style="margin-bottom: 0px;">
                                                <li><kbd>g</kbd></li>
                                                <li>then</li>
                                                <li><kbd>d</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Open Profile</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>g</kbd></li>
                                                <li>then</li>
                                                <li><kbd>p</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Joined Organizations</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>g</kbd></li>
                                                <li>then</li>
                                                <li><kbd>o</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Favourites</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>g</kbd></li>
                                                <li>then</li>
                                                <li><kbd>f</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Watching</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>g</kbd></li>
                                                <li>then</li>
                                                <li><kbd>w</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Toggle Sidebar</td>
                                        <td>
                                            <kbd>[</kbd>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Create wiki</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>c</kbd></li>
                                                <li>then</li>
                                                <li><kbd>w</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Create Organization</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>c</kbd></li>
                                                <li>then</li>
                                                <li><kbd>o</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                            	</tbody>
                            </table>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h3 style="font-size: 17px;">Wiki & Page Shortcuts</h3>
                            <hr>
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Key Combinations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Add to Watch List</td>
                                        <td><kbd>w</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Star</td>
                                        <td>
                                            <kbd>s</kbd>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Create Page inside Wiki</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>c</kbd></li>
                                                <li>then</li>
                                                <li><kbd>p</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Delete Page</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>d</kbd></li>
                                                <li>then</li>
                                                <li><kbd>p</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Delete Wiki</td>
                                        <td>
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                <li><kbd>d</kbd></li>
                                                <li>then</li>
                                                <li><kbd>w</kbd></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 style="font-size: 17px;">Editor Shortcuts</h3>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>PC</th>
                                        <th>Mac</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bold</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>b</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>b</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Italic</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>I</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>I</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Underline</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>U</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>U</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Select All</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>A</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>A</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Redo</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Y</kbd> / <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>Z</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>Y</kbd> / <kbd>Command</kbd> + <kbd>Shift</kbd> + <kbd>Z</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Undo</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Z</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>Z</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 1</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>1</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>1</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 2</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>2</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>2</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 3</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>3</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>3</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 4</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>4</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>4</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 5</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>5</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>5</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Header 6</td>
                                        <td><kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>6</kbd></td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>6</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Toggle Fullscreen</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>F</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>Shift</kbd> + <kbd>F</kbd></td>
                                    </tr>
                                    <tr>
                                        <td>Find</td>
                                        <td><kbd>Ctrl</kbd> + <kbd>F</kbd></td>
                                        <td><kbd>Command</kbd> + <kbd>F</kbd></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
