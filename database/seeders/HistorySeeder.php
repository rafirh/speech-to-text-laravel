<?php

namespace Database\Seeders;

use App\Models\History;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        History::insert([
            [
                'user_id' => 1,
                'title' => 'Project Kickoff Meeting',
                'original_text' => 'In today\'s project kickoff meeting, we reviewed the project scope and discussed the major deliverables expected over the next quarter. The project manager outlined the key milestones and assigned preliminary roles to team members. We also went over the initial risk assessment and brainstormed strategies for mitigating potential challenges. Team members provided feedback on the proposed timeline, and we made a few adjustments to accommodate the availability of resources and expected completion dates.',
                'translated_text' => null,
                'language' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Weekly Team Sync',
                'original_text' => 'During our weekly team sync, each team member gave updates on their current tasks and highlighted any roadblocks they encountered. The development team reported good progress on feature implementation but identified a few dependencies that require assistance from the infrastructure team. The design team showcased the latest wireframes, and we provided feedback to ensure alignment with project requirements. We also reviewed the timeline for the coming week and discussed potential areas for cross-functional collaboration.',
                'translated_text' => null,
                'language' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Client Feedback Session',
                'original_text' => 'In this client feedback session, we reviewed the comments and suggestions received from the client on the project\'s latest version. The client expressed satisfaction with the overall progress but requested adjustments to specific features to better align with their business needs. We discussed the feasibility of these changes with the technical team and agreed on a timeline for implementation. Action items were assigned to relevant team members, and we scheduled a follow-up meeting in two weeks to review the updates.',
                'translated_text' => null,
                'language' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Monthly Planning Meeting',
                'original_text' => 'This monthly planning meeting focused on setting priorities for the upcoming month. We began by reviewing last month’s accomplishments, noting which projects were completed successfully and which items were delayed. The product team presented the roadmap, highlighting key features and enhancements to be prioritized in the coming sprint. We discussed resource allocation and made necessary adjustments to ensure that critical projects receive adequate support. Additionally, we identified training opportunities for team members to support skill development.',
                'translated_text' => null,
                'language' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Budget Review',
                'original_text' => 'In today\'s budget review, the finance team provided an in-depth analysis of our current financial standing. We examined the budget allocations for various departments and compared them with actual expenses over the past quarter. The team identified areas of overspending and proposed adjustments to optimize spending without impacting project deliverables. We also discussed potential cost-saving measures, including supplier negotiations and process optimizations. Finally, we reviewed the financial forecast for the upcoming months, considering both fixed and variable expenses.',
                'translated_text' => null,
                'language' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
