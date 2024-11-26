@extends('layout')

@section('content')
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">
        <h1 style="color: #f85f00; margin-bottom: 2rem;">My Profile</h1>
        
        <div style="margin-bottom: 1.5rem;">
            <h3 style="color: #666; margin-bottom: 0.5rem;">Name</h3>
            <p style="font-size: 1.1rem;">{{ $user->name }}</p>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <h3 style="color: #666; margin-bottom: 0.5rem;">Email</h3>
            <p style="font-size: 1.1rem;">{{ $user->email }}</p>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <h3 style="color: #666; margin-bottom: 0.5rem;">Account Type</h3>
            <p style="font-size: 1.1rem; text-transform: capitalize;">{{ $user->user_type }}</p>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <h3 style="color: #666; margin-bottom: 0.5rem;">Member Since</h3>
            <p style="font-size: 1.1rem;">{{ $user->created_at->format('F j, Y') }}</p>
        </div>

        @if($user->posts->count() > 0)
            <div style="margin-top: 2rem;">
                <h2 style="color: #f85f00; margin-bottom: 1rem;">My Posts</h2>
                <div style="display: grid; gap: 1rem;">
                    @foreach($user->posts as $post)
                        <div style="padding: 1rem; background: #f8f8f8; border-radius: 4px;">
                            <a href="/posts/{{ $post->slug }}" style="color: #000; text-decoration: none;">
                                <h3 style="margin: 0;">{{ $post->title }}</h3>
                            </a>
                            <p style="color: #666; margin: 0.5rem 0;">{{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($user->user_type === 'admin')
            <div style="margin-top: 3rem;">
                <h2 style="color: #f85f00; margin-bottom: 1rem;">Add New Basketball</h2>
                <form action="{{ route('basketballs.store') }}" method="POST" enctype="multipart/form-data" style="background: #f8f8f8; padding: 1rem; border-radius: 4px;">
                    @csrf
                    <div style="margin-bottom: 1rem;">
                        <label for="name" style="display: block; margin-bottom: 0.5rem;">Name:</label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label for="type" style="display: block; margin-bottom: 0.5rem;">Type:</label>
                        <select id="type" name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="Indoor">Indoor</option>
                            <option value="Outdoor">Outdoor</option>
                            <option value="Indoor/Outdoor">Indoor/Outdoor</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label for="price" style="display: block; margin-bottom: 0.5rem;">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label for="image" style="display: block; margin-bottom: 0.5rem;">
                            Image: <span style="color: #666; font-size: 0.9em;">(JPEG, PNG, WebP | Max: 2MB | Min: 200x200px)</span>
                        </label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/jpeg,image/png,image/webp" 
                               required 
                               style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                        @error('image')
                            <p style="color: red; font-size: 0.9em; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" style="background-color: #f85f00; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;">
                        Add Basketball
                    </button>
                </form>
            </div>

            <div style="margin-top: 3rem;">
                <h2 style="color: #f85f00; margin-bottom: 1rem;">Manage Basketballs</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f8f8;">
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Name</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Type</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Price</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Basketball::all() as $basketball)
                            <tr>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $basketball->name }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $basketball->type }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">${{ number_format($basketball->price, 2) }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">
                                    <button onclick="showEditForm({{ $basketball->id }})" style="background-color: #0074d9; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px; margin-right: 5px;">Edit</button>
                                    <form action="{{ route('basketballs.destroy', $basketball->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: #ff4136; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr id="editForm{{ $basketball->id }}" style="display: none;">
                                <td colspan="4" style="padding: 1rem; border: 1px solid #ddd;">
                                    <form action="{{ route('basketballs.update', $basketball->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div style="margin-bottom: 1rem;">
                                            <label for="edit_name{{ $basketball->id }}" style="display: block; margin-bottom: 0.5rem;">Name:</label>
                                            <input type="text" id="edit_name{{ $basketball->id }}" name="name" value="{{ $basketball->name }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                        </div>

                                        <div style="margin-bottom: 1rem;">
                                            <label for="edit_type{{ $basketball->id }}" style="display: block; margin-bottom: 0.5rem;">Type:</label>
                                            <select id="edit_type{{ $basketball->id }}" name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                                <option value="Indoor" {{ $basketball->type === 'Indoor' ? 'selected' : '' }}>Indoor</option>
                                                <option value="Outdoor" {{ $basketball->type === 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
                                                <option value="Indoor/Outdoor" {{ $basketball->type === 'Indoor/Outdoor' ? 'selected' : '' }}>Indoor/Outdoor</option>
                                            </select>
                                        </div>

                                        <div style="margin-bottom: 1rem;">
                                            <label for="edit_price{{ $basketball->id }}" style="display: block; margin-bottom: 0.5rem;">Price:</label>
                                            <input type="number" id="edit_price{{ $basketball->id }}" name="price" step="0.01" value="{{ $basketball->price }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                        </div>

                                        <div style="margin-bottom: 1rem;">
                                            <label for="edit_image{{ $basketball->id }}" style="display: block; margin-bottom: 0.5rem;">
                                                New Image <span style="color: #666; font-size: 0.9em;">(JPEG, PNG, WebP | Max: 2MB | Min: 200x200px)</span>
                                            </label>
                                            <input type="file" 
                                                   id="edit_image{{ $basketball->id }}" 
                                                   name="image" 
                                                   accept="image/jpeg,image/png,image/webp" 
                                                   style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                            @error('image')
                                                <p style="color: red; font-size: 0.9em; margin-top: 0.5rem;">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit" style="background-color: #f85f00; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; margin-right: 0.5rem;">
                                            Update Basketball
                                        </button>
                                        <button type="button" onclick="hideEditForm({{ $basketball->id }})" style="background-color: #999; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;">
                                            Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script>
                function showEditForm(id) {
                    document.getElementById('editForm' + id).style.display = 'table-row';
                }

                function hideEditForm(id) {
                    document.getElementById('editForm' + id).style.display = 'none';
                }
            </script>

            <div style="margin-top: 3rem;">
                <h2 style="color: #f85f00; margin-bottom: 1rem;">Manage All Posts</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f8f8;">
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Title</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Author</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Created</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Post::with('user')->get() as $post)
                            <tr>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $post->title }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">
                                    {{ $post->user ? $post->user->name : 'Deleted User' }}
                                </td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $post->created_at->format('M d, Y') }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">
                                    <a href="/posts/{{ $post->slug }}" style="background-color: #0074d9; color: white; text-decoration: none; padding: 5px 10px; border-radius: 3px; margin-right: 5px;">View</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: #ff4136; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 3rem;">
                <h2 style="color: #f85f00; margin-bottom: 1rem;">Admin Dashboard</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f8f8;">
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Name</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Email</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">User Type</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Member Since</th>
                            <th style="padding: 0.5rem; text-align: left; border: 1px solid #ddd;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::all() as $u)
                            <tr>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $u->name }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $u->email }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $u->user_type }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">{{ $u->created_at->format('F j, Y') }}</td>
                                <td style="padding: 0.5rem; border: 1px solid #ddd;">
                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: #ff4136; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection 