# Laravel Comprehensive Exam - PowerfulLaravel Project

**Time Limit:** 3 hours  
**Total Points:** 100  
**Passing Grade:** 70%

---

## Instructions
- Answer all questions based on Laravel 11/12 best practices
- Code examples should follow PSR-12 standards
- Consider security implications in your answers
- Reference specific examples from the PowerfulLaravel project where applicable

---

## Section 1: Routing & Middleware (15 points)

### Question 1.1 (5 points)
Analyze the following route definition from `routes/web.php`:
```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/trainings', ListTrainings::class)->name('trainings.index');
    Route::get('/trainings/create', CreateTraining::class)->name('trainings.create');
    Route::get('/trainings/{training}/edit', EditTraining::class)->name('trainings.edit');
});
```

a) Explain what each middleware does and why they are grouped together.  
b) What is the advantage of using named routes?  It allows you to explicitly call the file that youre aiming for.
c) How would you implement a custom middleware that checks if a user has completed at least one objective before accessing training routes?

### Question 1.2 (5 points)
Write a route group that:
- Only allows authenticated users with a "premium" user type
- Rate limits to 10 requests per minute
- Applies a custom `CheckSubscription` middleware
- Contains routes for viewing and managing "buffs"

### Question 1.3 (5 points)
Explain the difference between:
```php
Route::get('/profile', [ProfileController::class, 'show']);
Route::get('/profile', ProfileComponent::class);
Volt::route('/profile', 'profile');
```
When would you use each approach?

---

## Section 2: Eloquent ORM & Database (20 points)

### Question 2.1 (8 points)
Given the following relationships in the PowerfulLaravel project:
- User hasMany TrainingCategories
- User hasMany Trainings
- Training belongsTo TrainingCategory
- Training belongsTo TrainingMethod
- User belongsToMany Buff (through user_buffs)

a) Write the complete Eloquent relationship methods for the User model.  
b) How would you eager load all trainings with their categories and methods for a user?  
c) Write a query to get all users who have active buffs that expire within the next hour.

### Question 2.2 (7 points)
Create a migration for a new `achievements` table that:
- Has a composite unique key of `user_id` and `achievement_type`
- Tracks when the achievement was earned
- Stores metadata in a JSON column
- Has an index on `earned_at`
- Uses soft deletes

### Question 2.3 (5 points)
The `Training` model has this scope:
```php
public function scopeActive($query)
{
    return $query->where('active', true);
}
```

a) Explain what a query scope is and when to use them.  
b) Write a more complex scope that filters trainings by:
   - Date range
   - Minimum duration
   - Specific categories
   - With or without buffs applied

---

## Section 3: Livewire Components (20 points)

### Question 3.1 (10 points)
Analyze the `CreateObjectives` Livewire component:

```php
public function submit()
{
    $this->validate();
    Objective::create([
        'user_id' => Auth::id(),
        'objectives' => $this->objectives,
        'training_category_id' => $this->category_id,
    ]);
    
    session()->flash('message', 'Learning Objective Created Successfully!');
    $this->reset(['category_id', 'objectives']);
}
```

a) What security vulnerabilities might exist in this code?  
b) How would you implement real-time validation for the objectives field?  
c) Rewrite this method to:
   - Use database transactions
   - Dispatch a browser event
   - Log the action
   - Handle potential errors gracefully

### Question 3.2 (5 points)
Design a Livewire component that:
- Shows a real-time countdown for active buffs
- Allows users to extend buff duration
- Updates without page refresh
- Shows different UI states (active, expiring soon, expired)

### Question 3.3 (5 points)
Explain the difference between:
```php
public $property;
#[Locked] public $id;
#[Computed] public function totalScore() { }
```
When and why would you use each?

---

## Section 4: Blade Templating & Components (15 points)

### Question 4.1 (7 points)
The project uses custom Blade components like:
```blade
<x-ui.card title="Create Learning Objective">
    <x-form wire:submit="submit">
        <x-form.select ... />
        <x-form.textarea ... />
    </x-form>
</x-ui.card>
```

a) Create a reusable Blade component for displaying training statistics  
b) How do you pass data to anonymous Blade components?  
c) What's the difference between `@props` and `@attributes`?

### Question 4.2 (8 points)
Write a Blade view that:
- Extends a layout
- Uses conditional rendering based on user permissions
- Implements a loop with `@forelse`
- Includes another view with data
- Uses slots effectively
- Handles empty states gracefully

---

## Section 5: Authentication & Security (10 points)

### Question 5.1 (5 points)
The project uses Laravel's built-in authentication. Explain:
a) How email verification works in Laravel  
b) How to implement a custom guard for API authentication  
c) Best practices for handling password resets securely

### Question 5.2 (5 points)
Identify and fix security issues in this code:
```php
public function updateTraining(Request $request, $id)
{
    $training = Training::find($id);
    $training->update($request->all());
    return redirect()->route('trainings.index');
}
```

---

## Section 6: Advanced Concepts (10 points)

### Question 6.1 (5 points)
The Buff system uses pivot tables with additional attributes:
```php
return $this->belongsToMany(Buff::class, 'user_buffs')
    ->withPivot(['started_at', 'ends_at'])
    ->withTimestamps();
```

a) How do you access and update pivot data?  
b) Write a method that calculates the total score bonus from all active buffs  
c) How would you implement buff stacking rules?

### Question 6.2 (5 points)
Design a caching strategy for the PowerfulLaravel application that:
- Caches user statistics
- Invalidates cache when trainings are added
- Uses tagged cache for easy management
- Implements cache warming

---

## Section 7: Testing & Best Practices (10 points)

### Question 7.1 (5 points)
Write a feature test for the objective creation process that:
- Tests authentication requirements
- Validates input data
- Checks database changes
- Verifies flash messages
- Tests authorization (users can only create their own objectives)

### Question 7.2 (5 points)
Identify code smells and suggest improvements for:
```php
public function getUserTrainingScore($userId, $startDate, $endDate)
{
    $user = User::find($userId);
    $trainings = $user->trainings;
    $score = 0;
    foreach ($trainings as $training) {
        if ($training->created_at >= $startDate && $training->created_at <= $endDate) {
            $score += $training->duration * $training->RPE;
            if ($training->buffs->count() > 0) {
                foreach ($training->buffs as $buff) {
                    $score *= $buff->multiplier;
                }
            }
        }
    }
    return $score;
}
```

---

## Bonus Section: System Design (Extra 10 points)

### Bonus Question
Design a complete feature for "Training Plans" that allows users to:
- Create weekly/monthly training plans
- Set objectives for each plan
- Track progress against the plan
- Get notifications for upcoming trainings
- Share plans with other users

Include:
- Database schema
- Model relationships  
- Key Livewire components needed
- Security considerations
- Performance optimizations

---

## Answer Key Topics
When grading, consider:
- Understanding of Laravel concepts
- Security awareness
- Performance considerations
- Code organization and cleanliness
- Proper use of Laravel features
- Best practices adherence

---

## Essay Question (Required)

In 500 words or less, discuss how you would refactor the PowerfulLaravel application to implement:
1. A microservices architecture
2. API-first design
3. Real-time features using WebSockets
4. Horizontal scaling considerations

Consider the trade-offs and justify your architectural decisions.

---

**End of Exam**

Good luck! Remember to review your answers before submitting.