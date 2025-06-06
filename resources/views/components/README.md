# Custom Component Library Documentation

This is a comprehensive set of reusable Blade components for Laravel applications with built-in dark mode support and consistent styling.

## Component Overview

### UI Components

#### Card (`<x-ui.card>`)
A versatile container component with optional title and footer.

```blade
<x-ui.card title="User Profile" shadow="lg">
    <p>Card content goes here</p>
    
    <x-slot:footer>
        <button>Save Changes</button>
    </x-slot:footer>
</x-ui.card>
```

**Props:**
- `title` - Optional card header title
- `footer` - Optional footer slot
- `shadow` - Shadow size: `sm`, `md`, `lg`, `xl` (default: `md`)
- `padding` - Apply padding to body (default: `true`)
- `border` - Show border (default: `true`)

#### Stat Card (`<x-ui.stat-card>`)
Display metrics and statistics with icons.

```blade
<x-ui.stat-card 
    title="Total Users" 
    value="1,234" 
    color="blue"
    icon="users"
    trend="up"
    trend-value="+12%"
/>
```

**Props:**
- `title` - Metric label
- `value` - Metric value
- `color` - Color theme: `blue`, `green`, `orange`, `purple`, `red`, `yellow`
- `icon` - Icon name or Heroicon name
- `trend` - Trend direction: `up` or `down`
- `trendValue` - Trend percentage/value

#### Badge (`<x-ui.badge>`)
Color-coded labels for status and categories.

```blade
<x-ui.badge color="success" size="lg">Active</x-ui.badge>
<x-ui.badge color="warning" icon="o-exclamation">Pending</x-ui.badge>
```

**Props:**
- `color` - Badge color: `primary`, `secondary`, `success`, `warning`, `error`, `info`
- `size` - Badge size: `sm`, `md`, `lg`
- `rounded` - Border radius: `full`, `md`, `lg`, `none`
- `icon` - Optional icon

#### Alert (`<x-ui.alert>`)
Notification messages with different types.

```blade
<x-ui.alert type="success" dismissible>
    Your changes have been saved successfully!
</x-ui.alert>
```

**Props:**
- `type` - Alert type: `success`, `error`, `warning`, `info`
- `dismissible` - Show dismiss button (default: `false`)
- `icon` - Show type icon (default: `true`)

#### Empty State (`<x-ui.empty-state>`)
Placeholder for empty content areas.

```blade
<x-ui.empty-state 
    icon="o-folder-open"
    title="No projects found"
    description="Create your first project to get started">
    
    <x-slot:actions>
        <x-button>Create Project</x-button>
    </x-slot:actions>
</x-ui.empty-state>
```

**Props:**
- `icon` - Icon name or custom SVG
- `title` - Main message
- `description` - Additional description
- `actions` - Action buttons slot

#### Button Group (`<x-ui.button-group>`)
Group related buttons together.

```blade
<x-ui.button-group>
    <x-button>Edit</x-button>
    <x-button>Delete</x-button>
</x-ui.button-group>
```

**Props:**
- `vertical` - Stack buttons vertically (default: `false`)
- `size` - Button size

### Table Components

#### Data Table (`<x-table.data-table>`)
Complete table with headers and styling.

```blade
<x-table.data-table :headers="['Name', 'Email', 'Status']" striped>
    @foreach($users as $user)
        <x-table.table-row>
            <x-table.table-cell>{{ $user->name }}</x-table.table-cell>
            <x-table.table-cell>{{ $user->email }}</x-table.table-cell>
            <x-table.table-cell align="center">
                <x-ui.badge color="success">Active</x-ui.badge>
            </x-table.table-cell>
        </x-table.table-row>
    @endforeach
</x-table.data-table>
```

**Props:**
- `headers` - Array of header labels
- `striped` - Striped rows (default: `true`)
- `hoverable` - Hover effect on rows (default: `true`)
- `compact` - Reduce padding (default: `false`)

#### Table Row (`<x-table.table-row>`)
Individual table rows with hover effects.

**Props:**
- `hoverable` - Enable hover effect (default: `true`)
- `clickable` - Show pointer cursor (default: `false`)

#### Table Cell (`<x-table.table-cell>`)
Table cells with alignment options.

**Props:**
- `align` - Text alignment: `left`, `center`, `right`
- `compact` - Reduce padding
- `nowrap` - Prevent text wrapping (default: `true`)

### Form Components

#### Input (`<x-form.input>`)
Enhanced input fields with labels and validation.

```blade
<x-form.input 
    label="Email Address"
    name="email"
    type="email"
    icon="o-envelope"
    placeholder="john@example.com"
    hint="We'll never share your email"
    required
/>
```

**Props:**
- `label` - Field label
- `error` - Error message
- `icon` - Input icon
- `hint` - Helper text
- `required` - Show required indicator

#### Select (`<x-form.select>`)
Styled dropdown menus.

```blade
<x-form.select 
    label="Country"
    name="country"
    :options="['us' => 'United States', 'ca' => 'Canada']"
    placeholder="Select a country"
    required
/>
```

**Props:**
- `label` - Field label
- `error` - Error message
- `options` - Key-value array of options
- `placeholder` - Default option text
- `required` - Show required indicator

#### Textarea (`<x-form.textarea>`)
Multi-line text input.

```blade
<x-form.textarea 
    label="Description"
    name="description"
    rows="6"
    hint="Maximum 500 characters"
/>
```

**Props:**
- `label` - Field label
- `error` - Error message
- `hint` - Helper text
- `required` - Show required indicator
- `rows` - Number of rows (default: `4`)

### Layout Components

#### Page Header (`<x-layout.page-header>`)
Consistent page headers with breadcrumbs.

```blade
<x-layout.page-header 
    title="Dashboard"
    description="Welcome to your dashboard"
    :breadcrumbs="[
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Dashboard']
    ]">
    
    <x-slot:actions>
        <x-button>Create New</x-button>
    </x-slot:actions>
</x-layout.page-header>
```

**Props:**
- `title` - Page title
- `description` - Page description
- `breadcrumbs` - Array of breadcrumb items
- `actions` - Action buttons slot

## Dark Mode Support

All components automatically adapt to dark mode using Tailwind's `dark:` variant classes. The components will respect your application's dark mode implementation.

## Customization

You can customize any component by:
1. Passing additional classes via the `class` attribute
2. Using the `@props` merge functionality
3. Overriding specific properties

Example:
```blade
<x-ui.card class="bg-gradient-to-r from-blue-500 to-purple-600" :padding="false">
    Custom styled card
</x-ui.card>
```

## Color System

The components use a consistent color system:
- **Primary**: Blue shades
- **Secondary**: Gray shades  
- **Success**: Green shades
- **Warning**: Yellow shades
- **Error**: Red shades
- **Info**: Indigo shades

Each color automatically adjusts for dark mode.